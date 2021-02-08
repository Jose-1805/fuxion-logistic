<?php

namespace FuxionLogistic\Http\Controllers;


use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Correo;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\Empresario;
use FuxionLogistic\Models\Corte;
use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\Guia;
use FuxionLogistic\Models\MallaCobertura;
use FuxionLogistic\Models\NotificacionPush;
use FuxionLogistic\Models\OperadorLogistico;
use FuxionLogistic\Models\Pedido;
use FuxionLogistic\Models\Producto;
use FuxionLogistic\Models\TareasSistema;
use FuxionLogistic\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Facades\Datatables;

class CorteController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 4;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permisoModulo:'.$this->modulo_id.',' . $this->privilegio_superadministrador);
    }

    public function index()
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        return view('corte/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');

        $cortes = Corte::select('cortes.*',
            DB::raw('CONCAT(users.nombres," ",ifnull(users.apellidos,"")) as usuario'))
            ->join('users','cortes.user_id','=','users.id')
            ->orderBy('cortes.created_at','DESC')
            ->get();

        $table = Datatables::of($cortes);//->removeColumn('id');

        $table = $table->editColumn('pedidos',function ($row){
            return Pedido::where('corte_id',$row->id)->count();
        })
            ->editColumn('opciones',function ($row){
                $opc = '';
                if(Auth::user()->tieneFunciones($this->modulo_id,[4],false,$this->privilegio_superadministrador)) {
                    $opc .= '<a href="' . url('/corte/detalle') .'/'. $row->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Detalle"><i class="white-text fa fa-list-alt"></i></a>';
                }
                if(Auth::user()->tieneFunciones($this->modulo_id,[3],false,$this->privilegio_superadministrador)) {
                    if($row->guias_asignadas == 'no')
                    $opc .= '<a href="#!" class="btn btn-xs btn-danger margin-2 btn-eliminar-corte" data-corte="'.$row->id.'" data-toggle="tooltip" data-placement="bottom" title="Eliminar"><i class="white-text fa fa-trash"></i></a>';
                }
                return $opc;
            })->rawColumns(['opciones']);
        $table = $table->make(true);
        return $table;
    }

    public function importar(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,5,$this->privilegio_superadministrador))
            return redirect('/');
        return view('corte/importar')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,5,$this->privilegio_superadministrador))
            return redirect('/');
        $rol = \FuxionLogistic\Models\Rol::where('empresarios','si')->first();
        if(!$rol){
            return response(['error'=>['Para realizar la importación de pedidos de forma manual es necesario que exista un rol asignable a empresarios.']],422);
        }
        $rules = [
            'archivo'=>'required|file|mimes:xlsx,xls|max:1000'
        ];

        $mensajes = [
            'archivo.required'=>'Seleccione un archivo.',
            'archivo.file'=>'Seleccione un archivo',
            'archivo.mimes'=>'El archivo seleccionado debe ser de tipo .xls o .xlsx.',
            'archivo.max'=>'El tamaño maximo del archivo es de 1MB',
        ];

        $this->validate($request,$rules,$mensajes);
        $complete = true;
        $error = '';

        $corte_id = 0;
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        $estado_en_cola = EstadoPedido::where('asignacion_corte','si')->first();

        $serie = '';
        $correlativos_registrados = [];
        $correlativos_no_registrados = [];
        $primer_correlativo = 0;
        $ultimo_correlativo = 0;

        if(!$estado_en_cola || !$estado_pendiente){
            $error = 'Para registrar cortes asegurese de registrar los <a href="'.url("/estado-pedido/crear").'" target="_blank">estados del pedido</a> con corte asignado y pedido sin corte asignado.';
            $complete = false;
        }else{
            Excel::load($request->file('archivo'),function ($reader) use (&$rol,&$error,&$complete,&$corte_id,$estado_pendiente,$estado_en_cola,&$serie,&$correlativos_registrados,&$correlativos_no_registrados,&$primer_correlativo,&$ultimo_correlativo){

                $results = $reader->all();
                DB::beginTransaction();
                //se crea un nuevo registro de importacion
                $corte = new Corte();
                $corte->user_id = Auth::user()->id;
                $corte->numero = Corte::ultimoNumeroCorte()+1;
                $corte->save();
                $corte_id = $corte->id;
                $clientes_no_registrados = [];
                $clientes_nuevos = [];

                $i = 2;
                //foreach para relacionar los pedidos con los productos
                foreach ($results as $row){
                    $array = $row->toArray();
                    $contenido = false;
                    foreach ($array as $key => $value){
                        if($value){
                            $contenido = true;
                            break;
                        }
                    }

                    if($contenido) {
                        //se busca la bodega
                        $bodega = Bodega::where('alias', $row->warehouse)->first();
                        if (!$bodega) {
                            $error = 'No se ha encontrado ninguna bodega con el alias "' . $row->warehouse . '". Para corregir el error registre la bodega en el sistema. Error en linea #' . $i;
                            $complete = false;
                            return false;
                        }

                        //se busca si el empresario ya existe en el sistema
                        $empresario = Empresario::where('empresario_id', $row->customer_id)->first();
                        //si no existe el empresario se crea un registro nuevo
                        if (!$empresario) {
                            if (!$row->correo || $row->correo == '') {
                                $error = 'El correo de todos los empresarios es obligatorio, por favor registre el correo. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }
                            if (!$row->customer_id || $row->customer_id == '') {
                                $error = 'El campo customer_id de todos los empresarios es obligatorio, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }

                            if (!$row->telefono || $row->telefono == '') {
                                $error = 'El campo teléfono de todos los empresarios es obligatorio, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }

                            if (!$row->fecha_de_orden || $row->fecha_de_orden == '') {
                                $error = 'El campo fecha de orden de todos los registros es obligatorio, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }else{
                                $time = strtotime($row->fecha_de_orden);
                                if(date('m',$time) > 12 || !checkdate(date('m',$time),date('d',$time),date('Y',$time))){
                                    $error = 'El campo fecha de orden no contiene el formato correcto ("dd-mm-yyyy"), por favor revise la información en el campo solicitado. Error en linea #' . $i;
                                    $complete = false;
                                    return false;
                                }
                            }
                            if (!$row->fecha_de_impresion || $row->fecha_de_impresion == '') {
                                $error = 'El campo fecha de impresion de todos los registros es obligatorio, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }else{
                                $time = strtotime($row->fecha_de_impresion);
                                if(date('m',$time) > 12 || !checkdate(date('m',$time),date('d',$time),date('Y',$time))){
                                    $error = 'El campo fecha de impresión no contiene el formato correcto ("dd-mm-yyyy"), por favor revise la información en el campo solicitado. Error en linea #' . $i;
                                    $complete = false;
                                    return false;
                                }
                            }
                            if (!filter_var($row->correo, FILTER_VALIDATE_EMAIL)) {
                                $error = 'El valor de correo (' . $row->correo . ') no es válido. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }

                            //se validan usuarios con el mismo correo
                            /*$user_email = User::where('email', $row->correo)->first();
                            if ($user_email) {
                                $error = 'Ya existe un usuario con el correo (' . $row->correo . '). Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }*/

                            $user_client = new User();
                            $user_client->nombres = $row->full_name;
                            //$user_client->apellidos = $row->last_name_ped;
                            $user_client->telefono = str_replace(['(',')','+57',' ','-'],[''],$row->telefono);
                            $user_client->email = $row->correo;
                            $user_client->tipo_identificacion = 'C.C';
                            $user_client->identificacion = $row->identificaion_del_cliente;
                            $user_client->rol_id = $rol->id;
                            //ACTUALIZA EL INICIO DE SESSION Y PASSWORD DEL CLIENTE
                            //COMENTAR LAS SIGUIENTES DOS LINEAS SI NO ES NECESARIA LA FUNCIONALIDAD
                            $user_client->password = Hash::make('123456789');
                            $user_client->sesion_fuxion_trax = 'si';
                            $user_client->save();



                            $empresario = new Empresario();
                            $empresario->tipo = $row->customer_type;
                            $empresario->empresario_id = $row->customer_id;
                            $empresario->enroler_id = $row->enroller_id;
                            $empresario->user_id = $user_client->id;
                            $empresario->save();
                            //que no está en la tabla de empresarios
                            if(!array_key_exists($empresario->id,$clientes_no_registrados))
                                $clientes_no_registrados[$empresario->id] = true;
                        }else{
                            if(!array_key_exists($empresario->id,$clientes_no_registrados))
                                $clientes_no_registrados[$empresario->id] = false;
                        }

                        if(!array_key_exists($empresario->id,$clientes_nuevos)) {
                            $empresario->validarNuevoAntiguo();
                            $clientes_nuevos[$empresario->id] = $empresario->nuevo;
                        }

                        //se busca si existe la orden con el mismo orden_id
                        $pedido = Pedido::where('orden_id', $row->order_id)->first();
                        //si existe se conprueba que este relacionado con la misma importación
                        if ($pedido) {
                            if ($pedido->corte_id && $pedido->corte_id != $corte->id) {
                                $error = 'Ya se ha registrado un pedido con código ' . $row->order_id . ' Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }
                        } else {
                            if (!$row->order_id || $row->order_id == '') {
                                $error = 'El campo order_id es requerido en el formato, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }

                            if (!$row->direccion_referencia || $row->direccion_referencia == '') {
                                $error = 'El campo dirección de todos los pedidos es obligatorio, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }
                            if (!$row->ciudad || $row->ciudad == '') {
                                $error = 'El campo ciudad de todos los pedidos es obligatorio, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }

                            //se crea el pedido si no existe
                            //dd(floatval(str_replace(['$',','],'',$row->subtotal)));
                            $pedido = new Pedido();
                            $pedido->fecha_orden = $row->fecha_de_orden;//date('Y-d-m h:i:s',strtotime((string)$row->fecha_de_orden));
                            $pedido->fecha_impresion = $row->fecha_de_impresion;//date('Y-d-m h:i:s',strtotime((string)$row->fecha_de_impresion));
                            $pedido->serie = $row->serie;
                            $pedido->correlativo = $row->correlativo;
                            $pedido->orden_id = $row->order_id;
                            $pedido->impreso_por = $row->impreso_por;
                            $pedido->subtotal = floatval(str_replace(['$',','],'',$row->subtotal));
                            $pedido->total_tax = floatval(str_replace(['$',','],'',$row->total_tax));
                            $pedido->total = floatval(str_replace(['$',','],'',$row->order_total));
                            $pedido->descuento = floatval(str_replace(['$','%',','],'',$row->discount));
                            $pedido->tipo_pago = $row->payment_type;
                            $pedido->volumen_comisionable = floatval(str_replace(['$',','],'',$row->commissionable_volume));
                            $pedido->costo_envio = floatval(str_replace(['$',','],'',$row->shipping_charge));
                            $pedido->empresario_id = $empresario->id;
                            $pedido->bodega_id = $bodega->id;
                            $pedido->corte_id = $corte->id;
                            $pedido->corte_importacion_id = $corte->id;
                            $pedido->first_name = $row->first_name_ped;
                            $pedido->last_name = $row->last_name_ped;
                            $pedido->email = $row->correo;
                            $pedido->direccion = trim($row->direccion_referencia);
                            $ciudad = Ciudad::porNombre(trim($row->ciudad));
                            if(!$ciudad){
                                $error = 'La ciudad "'.trim($row->ciudad).'" no ha sido encontrada en el sistema, por favor revise la información en el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }
                            $departamento = Departamento::porNombre(trim($row->departamento));
                            if(!$departamento){
                                $error = 'El departamento "'.trim($row->departamento).'" no ha sido encontrado en el sistema, por favor revise la información en el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }
                            $pedido->ciudad_id = $ciudad->id;
                            $pedido->departamento_id = $departamento->id;
                            $pedido->save();
                        }

                        //se consulta si existe el producto
                        $producto = Producto::where('codigo', $row->item_code)->first();
                        //si no existe el producto se crea el registro
                        if (!$producto) {
                            if (!$row->item_code || $row->item_code == '') {
                                $error = 'El campo item code es requerido en el formato, por favor registre el campo solicitado. Error en linea #' . $i;
                                $complete = false;
                                return false;
                            }
                            $producto = new Producto();
                            $producto->codigo = trim($row->item_code);
                            $producto->descripcion = trim($row->item_description);
                            $producto->save();
                        }

                        //se relaciona el corte con el producto
                        $pedido->productos()->save($producto, [
                            'cantidad' => floatval(str_replace(['$',','],'',$row->quantity/10000)),
                            'precio_unitario' => floatval(str_replace(['$',','],'',$row->price_each)),
                            'total' => floatval(str_replace(['$',',',')','('],'',$row->order_line_total))
                        ]);
                    }
                    $i++;
                }

                $pedidos_corte = $corte->pedidos;

                //foreach para determinar el estado de cada pedido y su relacion con el corte
                foreach ($pedidos_corte as $pedido){
                    if($primer_correlativo == 0) {
                        $primer_correlativo = $pedido->correlativo;
                        $serie = $pedido->serie;
                    }
                    $ultimo_correlativo = $pedido->correlativo;

                    $correlativos_registrados[$pedido->correlativo] = true;
                    $empresario = $pedido->empresario;
                    $empresario_kit = false;
                    $pedido_con_kit = false;

                    $productos_pedido = $pedido->productos;
                    foreach ($productos_pedido as $producto){
                        if($producto->descripcion == 'KIT DE AFILIACION COLOMBIA'){
                            $empresario->kit = 'si';
                            $empresario->save();
                            $pedido_con_kit = true;
                        }
                    }

                    //si el empresario tiene kit registrado
                    //o aparece en la lista de empresarios con kit
                    if($empresario->validarKit() || $empresario->tipo == 'Preferred Customer'){
                        $empresario_kit = true;
                    }

                    $en_cola = false;
                    //si el empresario tiene kit y flete debe quedar en cola y con la relacion con el corte
                    //de lo contrario se quita la relacion con el corte y se deja pendiente
                    if($empresario_kit){
                        if($pedido->costo_envio){
                            $en_cola = true;
                        }else{
                            if($pedido_con_kit && !$clientes_no_registrados[$empresario->id]){
                                $pedido_pendiente_kit = Pedido::segunEstadoActual($estado_pendiente->id,'Pendiente por kit')
                                    ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
                                    ->where('empresarios.id',$empresario->id)->first();

                                if($pedido_pendiente_kit){
                                    $en_cola = true;
                                }
                            }
                        }
                    }

                    if($en_cola){
                        $pedido->estadosPedidos()->save($estado_en_cola,['razon_estado'=>'Pendiente por numero de guía']);
                        Correo::pedidoEnColaEmpresario($empresario,$pedido);
                        NotificacionPush::cambioEstado($pedido,$estado_en_cola,$estado_en_cola->nombre);

                        //si el pedido no tiene kit
                        //y el cliente es nuevo
                        //se busca un pedido de un kit relacionado con el mismo corte y se actualiza el estado en cola
                        if(!$pedido_con_kit && $clientes_no_registrados[$empresario->id]){
                            if($clientes_nuevos[$empresario->id]) {
                                $pedido_kit = Pedido::segunEstadoActual($estado_pendiente->id, 'Pendiente por pedido')
                                    ->join('empresarios', 'pedidos.empresario_id', '=', 'empresarios.id')
                                    ->where('empresarios.id', $empresario->id)
                                    ->first();
                            }else if(!$clientes_nuevos[$empresario->id]){
                                $pedido_kit = Pedido::segunEstadoActual($estado_pendiente->id, 'Pendiente por flete')
                                    ->join('empresarios', 'pedidos.empresario_id', '=', 'empresarios.id')
                                    ->where('empresarios.id', $empresario->id)
                                    ->first();
                            }
                            if ($pedido_kit) {
                                $pedido_kit->corte_id = $corte->id;
                                $pedido_kit->save();
                                $pedido_kit->estadosPedidos()->save($estado_en_cola, ['razon_estado' => 'Pendiente por numero de guía']);
                                Correo::pedidoEnColaEmpresario($empresario, $pedido_kit);
                                NotificacionPush::cambioEstado($pedido_kit, $estado_en_cola, $estado_en_cola->nombre);
                            }
                        }

                        //buscar pedido pendiente por (kit, pedido) y relacionar con corte
                        $pedido_pendiente_kit = Pedido::segunEstadoActual($estado_pendiente->id,'Pendiente por kit')
                            ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
                            ->where('empresarios.id',$empresario->id)->first();
                        if($pedido_pendiente_kit){
                            $pedido_pendiente_kit->corte_id = $corte->id;
                            $pedido_pendiente_kit->save();
                            $pedido_pendiente_kit->estadosPedidos()->save($estado_en_cola,['razon_estado'=>'Pendiente por numero de guía']);
                            Correo::pedidoEnColaEmpresario($empresario,$pedido_pendiente_kit);
                        }

                        $pedido_pendiente_pedido = Pedido::segunEstadoActual($estado_pendiente->id,'Pendiente por pedido')
                            ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
                            ->where('empresarios.id',$empresario->id)->first();
                        if($pedido_pendiente_pedido){
                            $pedido_pendiente_pedido->corte_id = $corte->id;
                            $pedido_pendiente_pedido->save();
                            $pedido_pendiente_pedido->estadosPedidos()->save($estado_en_cola, ['razon_estado'=>'Pendiente por numero de guía']);
                            Correo::pedidoEnColaEmpresario($empresario,$pedido_pendiente_pedido);
                        }
                    }else{
                        if(!$empresario_kit) {
                            $pedido->estadosPedidos()->save($estado_pendiente,['razon_estado'=>'Pendiente por kit']);
                        } else {
                            if($pedido_con_kit) {
                                //si es un cliente nuevo debe quedar en pendiente por pedido
                                if($clientes_no_registrados[$empresario->id] && $clientes_nuevos[$empresario->id])
                                    $pedido->estadosPedidos()->save($estado_pendiente, ['razon_estado' => 'Pendiente por pedido']);
                                else
                                    $pedido->estadosPedidos()->save($estado_pendiente, ['razon_estado' => 'Pendiente por flete']);
                            } else {
                                $pedido->estadosPedidos()->save($estado_pendiente, ['razon_estado' => 'Pendiente por flete']);
                            }
                        }
                        $pedido->corte_id = null;
                    }
                    $pedido->save();
                }

                ksort($correlativos_registrados);

                for($i = $primer_correlativo;$i <= $ultimo_correlativo;$i++){
                    if(!array_key_exists($i,$correlativos_registrados))
                        $correlativos_no_registrados[] = $i;
                }
            });

            //******************************************
            //se relacionan todos los pedidos pendientes sin razón de estado
            $pedidos_pendientes = Pedido::segunEstadoActual($estado_pendiente->id,'null')->select('pedidos.*')->get();
            if(count($pedidos_pendientes)){
                //TareasSistema::setMasivo('pedidos','corte_id',$corte_id,$pedidos_pendientes);
                foreach ($pedidos_pendientes as $p_p){
                    $p_p->corte_id = $corte_id;
                    $p_p->save();
                    $p_p->estadosPedidos()->save($estado_en_cola,['razon_estado'=>'Pendiente por numero de guía']);
                }
            }
        }

        if(!$complete) {
            DB::rollBack();
            return response(['error' => [$error]], 422);
        }else {
            DB::commit();
            if(count($correlativos_no_registrados)) {
                $mensaje = 'Los siguientes consecutivos de facturación no se incluyeron en la importación del corte: ';
                foreach ($correlativos_no_registrados as $c){
                    $mensaje .= $serie.'-'.$c.', ';
                }
                $mensaje = trim($mensaje,', ').'.';
                return ['success' => true,'mensaje_info'=>$mensaje];
            }else{
                return ['success' => true];
            }
        }
    }

    public function detalle($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        $corte = Corte::find($id);
        if(!$corte)return redirect('/corte');

        return view('corte/detalle')
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador)
            ->with('corte',$corte);
    }

    public function listaPedidosCorte($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        $corte = Corte::find($id);
        if(!$corte)return redirect('/corte');

        $pedidos = Pedido::select('pedidos.*',DB::raw('CONCAT(users.nombres," ",ifnull(users.apellidos,"")) as empresario'))
            ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
            ->join('users','empresarios.user_id','=','users.id')
            ->where('pedidos.corte_id',$id)
            ->get();

        $table = Datatables::of($pedidos);//->removeColumn('id');

        /*$table = $table->editColumn('bodega',function ($row){
            return $row->bodega->nombre;
        })
        ->editColumn('precio_unitario',function ($row){
            return '$ '.number_format($row->precio_unitario,2,',','.');
        })
        ->editColumn('total_producto',function ($row){
            return '$ '.number_format($row->total_producto,2,',','.');
        })
        ->editColumn('total_tax',function ($row){
            return '$ '.number_format($row->total_tax,2,',','.');
        })
        ->editColumn('costo_envio',function ($row){
            return '$ '.number_format($row->costo_envio,2,',','.');
        })
        ->editColumn('descuento',function ($row){
            return number_format($row->descuento,2,',','.').'%';
        })
        ->editColumn('total',function ($row){
            return '$ '.number_format($row->total,2,',','.');
        });*/

        $table = $table->make(true);
        return $table;
    }

    public function aplicarMallaCobertura($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);

        $corte = Corte::find($id);
        if (!$corte) return response(['error' => ['La información enviada es incorrecta.']], 422);

        if(Corte::permitirProcesar($corte)) {

            if (!$corte) return response(['error' => ['La información enviada es incorrecta.']], 422);
            if ($corte->guias_asignadas == 'si') return ['success' => true];

            DB::beginTransaction();
            $pedidos = $corte->pedidos;

            $malla_cobertura_defecto = MallaCobertura::where('destino', 'DEFECTO')->first();
            if (!$malla_cobertura_defecto) return response(['error' => ['No existe ningún operador logístico para aplicar malla de cobertura por defecto; para agregar vaya al menú <a href="' . url('malla-cobertura/crear') . '">Malla de cobertura opción agregar</a>, registre una malla de cobertura con destino "DEFECTO" y seleccione el operador logístico deseado.']], 422);

            $pedidos_procesados = [];
            foreach ($pedidos as $ped) {
                if(!array_key_exists($ped->id,$pedidos_procesados)) {
                    $malla_cobertura = MallaCobertura::where('destino', $ped->ciudad->nombre)->first();
                    //si el destino no tiene malla de cobertura
                    //se relaciona con una por defecto
                    if (!$malla_cobertura) $malla_cobertura = $malla_cobertura_defecto;

                    $pedidos_relacionados = Pedido::where('empresario_id', $ped->empresario_id)
                        ->where('corte_id', $ped->corte_id)->get();
                    //si es un solo pedido se relaciona con una nueva guia
                    if (count($pedidos_relacionados) == 1) {
                        $guia = new Guia();
                        $guia->malla_cobertura_id = $malla_cobertura->id;
                        $guia->operador_logistico_id = $malla_cobertura->operador_logistico_id;
                        $guia->save();
                        $guia->pedidos()->save($pedidos_relacionados[0]);
                        $pedidos_procesados[$pedidos_relacionados[0]->id] = true;
                    } else {
                        $kit = false;

                        //si tiene dos pedidos se evalua si uno contiene kit de afiliacion
                        if (count($pedidos_relacionados) == 2) {
                            foreach ($pedidos_relacionados as $ped_) {
                                if ($ped_->tieneKit()) {
                                    $kit = true;
                                    break;
                                }
                            }
                        }

                        //si contiene el kit se debe enviar en una sola guia
                        if ($kit) {
                            $guia = new Guia();
                            $guia->malla_cobertura_id = $malla_cobertura->id;
                            $guia->operador_logistico_id = $malla_cobertura->operador_logistico_id;
                            $guia->save();

                            foreach ($pedidos_relacionados as $ped_2) {
                                $guia->pedidos()->save($ped_2);
                                $pedidos_procesados[$ped_2->id] = true;
                            }
                        } else {
                            foreach ($pedidos_relacionados as $ped_3) {
                                $guia = new Guia();
                                $guia->malla_cobertura_id = $malla_cobertura->id;
                                $guia->operador_logistico_id = $malla_cobertura->operador_logistico_id;
                                $guia->save();
                                $guia->pedidos()->save($ped_3);
                                $pedidos_procesados[$ped_3->id] = true;
                            }
                        }
                    }
                }
            }
            $corte->guias_asignadas = 'si';
            $corte->save();
            //se envia información de los productos relacionados en el corte a  repremundo
            $corte->enviarInfoRepremundo();
            DB::commit();
            return ['success' => true];
        }
        return ['success' => false];
    }

    public function guias($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        $corte = Corte::find($id);
        if(!$corte)return redirect('/');

        if(Corte::permitirProcesar($corte))
            return view('corte.guias')->with('corte',$corte)->with('privilegio_superadministrador',$this->privilegio_superadministrador);

        return redirect('/');
    }

    public function guiasOperadorLogistico($corte,$operadorLogistico){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');

        $corte = Corte::find($corte);
        $operador_logistico = OperadorLogistico::find($operadorLogistico);

        if(!$corte || !$operador_logistico)return redirect('/');

        if(Corte::permitirProcesar($corte))
            return view('corte.guias_operador_logistico')
                ->with('corte',$corte)
                ->with('operador_logistico',$operador_logistico)
                ->with('privilegio_superadministrador',$this->privilegio_superadministrador);

        return redirect('/');
    }

    public function listaGuiasOperadorLogistico($corte,$operadorLogistico){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');

        $corte = Corte::find($corte);
        $operador_logistico = OperadorLogistico::find($operadorLogistico);

        if(!$corte || !$operador_logistico)return redirect('/');

        $guias = $operador_logistico->guiasAsignadasPorCorte($corte->id);

        $table = Datatables::of($guias);//->removeColumn('id');

        $table = $table->editColumn('correlativo',function ($row){
            return str_replace(',','/',$row->correlativo_2);
        })->rawColumns(['seleccione']);

        $table = $table->editColumn('seleccione',function ($row){
            if(!$row->numero)
            return '<input type="checkbox" name="guias[]" value="'.$row->id.'">';

        })->rawColumns(['seleccione']);
        $table = $table->make(true);
        return $table;
    }

    public function reasignarGuiasOperadorLogistico(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);

        if(!$request->has('guias'))
            return response(['error'=>['No se ha seleccionado ningúna guía']],422);

        if(!is_array($request->input('guias')))
            return response(['error'=>['La información enviada es incorrecta']],422);

        if(!$request->has('operador'))
            return response(['error'=>['Seleccione un operador logístico']],422);

        $operador_logistico = OperadorLogistico::find($request->input('operador'));

        if(!$operador_logistico)
            return response(['error'=>['La información enviada es incorrecta']],422);

        foreach ($request->input('guias') as $id_guia){
            $guia = Guia::where('estado','registrada')->whereNull('numero')->find($id_guia);
            if($guia->operador_logistico_id != $operador_logistico->id){
                $guia->update(
                    ['operador_logistico_id'=>$operador_logistico->id]
                );
            }
        }
        return ['success'=>true];
    }

    public function descargaGuias($corte_id,$operador_logistico_id){
        $corte = Corte::find($corte_id);
        $operador_logistico = OperadorLogistico::find($operador_logistico_id);
        return $operador_logistico->excelGuias($corte->id);
    }

	public function informeProductos($corte_id){
        $corte = Corte::find($corte_id);

        return $corte->excelProductosPorCorte($corte->id);
    }

    public function guiasManuales($corte_id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');
        $corte = Corte::find($corte_id);
        if(!$corte)return redirect('/');
        if(Corte::permitirProcesar($corte))
        return view('corte.guias_manuales')->with('corte',$corte)->with('privilegio_superadministrador',$this->privilegio_superadministrador);

        return redirect('/');
    }

    public function procesarGuiasManuales(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');

        $rules = [
            'archivo'=>'required|file|mimes:xlsx,xls|max:1000',
            'corte'=>'required|exists:cortes,id',
            'operador_logistico'=>'required|exists:operadores_logisticos,id',
        ];

        $mensajes = [
            'archivo.required'=>'Seleccione un archivo.',
            'archivo.file'=>'Seleccione un archivo',
            'archivo.mimes'=>'El archivo seleccionado debe ser de tipo .xls o .xlsx.',
            'archivo.max'=>'El tamaño maximo del archivo es de 1MB',
            'corte.required'=>'La información enviada es incorrecta',
            'corte.exists'=>'La información enviada es incorrecta',
            'operador_logistico.required'=>'La información enviada es incorrecta',
            'operador_logistico.exists'=>'La información enviada es incorrecta',
        ];

        $this->validate($request,$rules,$mensajes);
        $error = false;
        $mensaje_error = '';
        $guias_relacionadas = 0;
        $estado_en_cola = EstadoPedido::where('asignacion_corte','si')->first();
        if(!$estado_en_cola)
            return response(['error'=>['Para procesar guías manuales asegurese de registrar el <a href="'.url("/estado-pedido/crear").'" target="_blank">estado de pedido</a> con corte asignado.']],422);
        DB::beginTransaction();
        $corte = Corte::find($request->corte);
        if(Corte::permitirProcesar($corte)) {
            Excel::load($request->file('archivo'), function ($reader) use ($request, &$error, &$mensaje_error, &$guias_relacionadas, $estado_en_cola, &$corte) {

                $operador_logistico = OperadorLogistico::find($request->operador_logistico);
                $results = $reader->all();
                foreach ($results as $row) {
                    $row = $row->toArray();
                    $contenido = false;
                    foreach ($row as $key => $value) {
                        if ($value && $value != '') {
                            $contenido = true;
                            break;
                        }
                    }

                    if ($contenido) {
                        if ((strtolower($operador_logistico->nombre) == 'servientrega' && array_key_exists('numero_documento_cliente2', $row) && array_key_exists('numero_guia', $row))
                            || (strtolower($operador_logistico->nombre) == 'deprisa' && array_key_exists('referencia', $row) && array_key_exists('envio', $row))
                        ) {

                            if (strtolower($operador_logistico->nombre) == 'deprisa') {
                                $numero_guia = $row['envio'];
                                $data_fact = explode('-', $row['referencia']);
                                $serie = $data_fact[0];
                                $correlativo = explode('/', $data_fact[1])[0];
                            } else if (strtolower($operador_logistico->nombre) == 'servientrega') {
                                $numero_guia = $row['numero_guia'];
                                $data_fact = explode('-', $row['numero_documento_cliente2']);
                                $serie = $data_fact[0];
                                $correlativo = explode('/', $data_fact[1])[0];
                            }

                            $guia = Guia::select('guias.*')
                                ->join('guias_pedidos', 'guias.id', '=', 'guias_pedidos.guia_id')
                                ->join('pedidos', 'guias_pedidos.pedido_id', '=', 'pedidos.id')
                                ->join('cortes', 'pedidos.corte_id', '=', 'cortes.id')
                                ->where('cortes.id', $corte->id)
                                ->where('pedidos.serie', $serie)
                                ->where('pedidos.correlativo', $correlativo)
                                ->where('guias.operador_logistico_id', $operador_logistico->id)
                                ->where('guias.estado', 'registrada')->first();

                            if (!$guia) {
                                $error = true;
                                $mensaje_error = 'No se ha encontrado ningún pedido con serie-correlativo ' . $serie . '-' . $correlativo . ' para el corte y operador logístico actual.';
                                return false;
                            }

                            if (!$guia->numero) {
                                $guia->numero = $numero_guia;
                                $guia->estado = 'enviada';
                                $guia->save();
                                $pedidos = $guia->pedidos;
                                foreach ($pedidos as $pedido) {
                                    $pedido->estadosPedidos()->save($estado_en_cola);
                                }
                                $guias_relacionadas++;
                            }
                        }
                    }
                }
            });
        }else{
            $error = true;
            $mensaje_error = 'No es posible procesar la información del corte.';
        }

        if($error){
            DB::rollBack();
            return response(['error'=>[$mensaje_error.'<br>No se proceso ninguna guía']],422);
        }else{
            DB::commit();
            $redirect = false;
            if($corte->procesarCorte()){
                Session::push('msj_success','Las guías manuales fueron procesadas con éxito y el estado del corte ha sido actualizado.');
                $redirect = url('corte');
            }
            return ['success'=>true,'guias_relacionadas'=>$guias_relacionadas,'redirect'=>$redirect];
        }
    }

    public function guiasAutomaticas(Request $request){
        if($request->has('corte_id')) {
            $corte_id = $request->input('corte_id');
            $corte = Corte::find($corte_id);
            if(Corte::permitirProcesar($corte)) {
                $errores = [];
                $guias_relacionadas = 0;
                if (!$corte || $corte->estado != 'transmitido')
                    return response(['error' => ['La información enviada es incorrecta']], 422);

                $operadores_logisticos = OperadorLogistico::where('ws', 'si')->get();
                foreach ($operadores_logisticos as $operador_logistico) {
                    $data = $operador_logistico->enviarGuiasAutomaticas($corte->id);
                    if (count($data['errores']))
                    $errores = array_merge($errores, $data['errores']);

                    $guias_relacionadas += $data['guias_procesadas'];
                }

                if (count($errores)) {
                    return response(array_merge($errores, ['Se lograron procesar ' . $guias_relacionadas . ' guías.']), 422);
                } else {
                    $redirect = false;
                    if ($corte->procesarCorte()) {
                        Session::push('msj_success', 'Las guías fueron procesadas con éxito y el estado del corte ha sido actualizado.');
                        $redirect = url('corte');
                    }
                    return ['success' => true, 'guias_relacionadas' => $guias_relacionadas, 'redirect' => $redirect];
                }
            }
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    protected function establecerFecha($fecha){
        $fecha_corta = date('Y-m-d',strtotime($fecha));
        $datos = explode('-',$fecha_corta);
        $fecha_real = $datos[0].'-'.$datos[2].'-'.$datos[1];
        if(checkdate($datos[2],$datos[1],$datos[0]))
            return str_replace($fecha_corta,$fecha_real,$fecha);

        $fecha_real = $datos[0].'-'.$datos[1].'-'.$datos[2];
        if(checkdate($datos[1],$datos[2],$datos[0]))
            return str_replace($fecha_corta,$fecha_real,$fecha);
        return false;
    }

    public function eliminar(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        $corte = Corte::find($request->input('corte'));
        if(!$corte || $corte->guias_asignadas == 'si')return response(['error'=>['La información enviada es incorrecta.']],422);
        $corte->delete();
        return ['success'=>true];
    }
}