<?php
namespace FuxionLogistic\Http\Controllers;
use function foo\func;
use FuxionLogistic\Http\Requests\RequestBodega;
use FuxionLogistic\Http\Requests\RequestSoporteEmpresario;
use FuxionLogistic\Mail\PlantillaCorreo;
use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Correo;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\FacturaFlete;
use FuxionLogistic\Models\FacturaKit;
use FuxionLogistic\Models\FacturaPedido;
use FuxionLogistic\Models\Guia;
use FuxionLogistic\Models\EstadoGuiaOperadorLogistico;
use FuxionLogistic\Models\HistorialEmpresario;
use FuxionLogistic\Models\Pedido;
use FuxionLogistic\Models\ReporteSoporteEmpresario;
use FuxionLogistic\Models\Ubicacion;
use FuxionLogistic\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
class SoporteEmpresarioController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 12;
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
        return view('soporte_empresario/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }
    public function lista(Request $request){
        $pedidos = Pedido::segunEstadoActual();
        if($request->has('estado')) {
            $pedidos = $pedidos->where(function ($q) use ($request){
                $q->where('historial_estados_pedidos.estado_pedido_id', $request->input('estado'));
                if($request->has('razon_estado')) {
                    if($request->input('razon_estado') != 'sin razón de estado')
                        $q->where('historial_estados_pedidos.razon_estado', $request->input('razon_estado'));
                    else
                        $q->whereNull('historial_estados_pedidos.razon_estado');
                }
            });
        }else{
            if($request->has('razon_estado')) {
                if($request->input('razon_estado') != 'sin razón de estado')
                    $pedidos = $pedidos->where('historial_estados_pedidos.razon_estado', $request->input('razon_estado'));
                else
                    $pedidos = $pedidos->whereNull('historial_estados_pedidos.razon_estado');
            }
        }
        $pedidos = $pedidos->join('estados_pedidos','historial_estados_pedidos.estado_pedido_id','=','estados_pedidos.id')
            ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
            ->join('users','empresarios.user_id','=','users.id')
			->join('ciudades','pedidos.ciudad_id','ciudades.id')
            ->leftJoin('guias_pedidos','pedidos.id','=','guias_pedidos.pedido_id')
            ->leftJoin('guias','guias_pedidos.guia_id','=','guias.id')
            ->where(function($q){
                $q->whereRaw("guias_pedidos.id IN (select max(guias_pedidos.id) as gp_id from guias_pedidos where guias_pedidos.pedido_id = pedidos.id group by guias_pedidos.pedido_id)")
                    ->orWhereNull("guias_pedidos.id");
            });
        $pedidos = $pedidos->select('pedidos.*',DB::raw('CONCAT(users.nombres," ",IFNULL(users.apellidos,"")) as empresario'),
            'pedidos.direccion',
			DB::raw('ciudades.nombre as ciudad'),
            DB::raw('CONCAT(pedidos.serie," ",pedidos.correlativo) as factura'),
            'guias.numero as numero_guia',
            DB::raw('estados_pedidos.nombre as estado_pedido'),
            'historial_estados_pedidos.razon_estado as razon_estado',
            'guias.estado as estado_guia')->get();
        $table = Datatables::of($pedidos);//->removeColumn('id');
        $table = $table->editColumn('estado_pedido', function ($row) {
            if($row->razon_estado){
                return $row->estado_pedido.' ('.$row->razon_estado.')';
            }else{
                return $row->estado_pedido;
            }
        })->rawColumns(['estado_pedido']);
        $table = $table->editColumn('opciones', function ($row) {
            $opc = '<a href="#!" class="btn btn-xs btn-primary margin-2 btn-tracking"><i class="white-text fa fa-truck"></i></a>'
            	.'<a href="#!" class="btn btn-xs btn-primary margin-2 btn-historial-guias"><i class="white-text fa fa-history"></i></a>'
                .'<a href="#!" class="btn btn-xs btn-primary margin-2 btn-imagenes-guias"><i class="white-text fa fa-picture-o"></i></a>';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" class="btn btn-xs btn-primary margin-2 opciones-soporte-empresario"><i class="white-text fa fa-th-list"></i></a>';
            }
            return $opc;
        })->rawColumns(['opciones']);
        if(!Auth::user()->tieneFunciones($this->modulo_id,[2],false,$this->privilegio_superadministrador))$table->removeColumn('opciones');
        $table = $table->make(true);
        return $table;
    }
    public function opciones(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        if($request->has('pedido')){
            $pedido = Pedido::find($request->input('pedido'));
            $estado = $pedido->ultimoEstado();
            if($pedido){
                $vista = view('soporte_empresario.opciones')->with('pedido',$pedido)->with('estado',$estado)->render();
                $numero_orden = $pedido->orden_id;
                return ['html'=>$vista,'numero_orden'=>$numero_orden];
            }
        }
        return ['html'=>'La información enviada es incorrecta','numero_orden'=>'0'];
    }
    public function historialGuias(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        if($request->has('pedido')){
            $pedido = Pedido::find($request->input('pedido'));
            if($pedido){
                $guias = Guia::select('guias.*','pedidos.serie','pedidos.correlativo')
                    ->join('guias_pedidos','guias.id','=','guias_pedidos.guia_id')
                    ->join('pedidos','guias_pedidos.pedido_id','=','pedidos.id')
                    ->where('pedidos.id',$pedido->id)
                    ->whereNotNull('guias.numero')
                    ->get();
                $vista = view('soporte_empresario.historial_guias')
                    ->with('pedido',$pedido)
                    ->with('guias',$guias)
                    ->render();
                $numero_orden = $pedido->orden_id;
                return ['html'=>$vista,'numero_orden'=>$numero_orden];
            }
        }
        return ['html'=>'La información enviada es incorrecta','numero_orden'=>'0'];
    }
    
    public function tracking(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        if($request->has('pedido')){
            $pedido = Pedido::find($request->input('pedido'));
            if($pedido){
               $trackings = EstadoGuiaOperadorLogistico::select('estados_guias_operadores_logisticos.*','operadores_logisticos.nombre')
                    ->join('guias','guias.id','=','estados_guias_operadores_logisticos.guia_id')
                    ->join('guias_pedidos','guias.id','=','guias_pedidos.guia_id')
                    ->join('pedidos','guias_pedidos.pedido_id','=','pedidos.id')
					->join('operadores_logisticos','guias.operador_logistico_id','=','operadores_logisticos.id')
                    ->where('pedidos.id',$pedido->id)
                    ->whereNotNull('guias.numero')
                    ->orderBy('estados_guias_operadores_logisticos.fecha','DESC')
                    ->get();
                $vista = view('soporte_empresario.tracking')
                    ->with('trackings',$trackings)
                    ->render();
                $numero_orden = $pedido->orden_id;
                return ['html'=>$vista,'numero_orden'=>$numero_orden];
            }
        }
        return ['html'=>'La información enviada es incorrecta','numero_orden'=>'0'];
    }
    public function imagenesGuia(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        if($request->has('pedido')){
            $pedido = Pedido::find($request->input('pedido'));
            if($pedido){
                $guia = Guia::select('guias.*','pedidos.serie','pedidos.correlativo')
                    ->join('guias_pedidos','guias.id','=','guias_pedidos.guia_id')
                    ->join('pedidos','guias_pedidos.pedido_id','=','pedidos.id')
                    ->where('pedidos.id',$pedido->id)
                    ->orderBy('guias.created_at','DESC')
                    ->first();
                if($guia) {
                    $vista = view('soporte_empresario.imagenes')
                        ->with('pedido', $pedido)
                        ->with('guia', $guia)
                        ->render();
                    return ['html' => $vista];
                }else{
                    return ['html'=>'<p class="text-center">Pedido sin guía asignada</p>'];
                }
            }
        }
        return ['html'=>'La información enviada es incorrecta'];
    }
    public function actualizarEmpresario(RequestSoporteEmpresario $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        if($request->has('pedido')){
            $pedido = Pedido::find($request->input('pedido'));
            if($pedido){
                DB::beginTransaction();
                $user = $pedido->empresario->user;
                if(
                    $pedido->first_name != $request->input('nombres')
                    || $pedido->last_name != $request->input('apellidos')
                    || $user->telefono != $request->input('telefono')
                    || $pedido->direccion != $request->input('direccion')
                    || $pedido->email != $request->input('email')
                ) {
                    $historial_empresario = new HistorialEmpresario();
                    $historial_empresario->nombres_anterior = $pedido->first_name;
                    $historial_empresario->apellidos_anterior = $pedido->last_name;
                    $historial_empresario->email_anterior = $pedido->email;
                    $historial_empresario->telefono_anterior = $user->telefono;
                    $historial_empresario->direccion_anterior = $pedido->direccion;
                    $historial_empresario->nombres_nuevo = $request->input('nombres');
                    $historial_empresario->apellidos_nuevo = $request->input('apellidos');
                    $historial_empresario->email_nuevo = $request->input('email');
                    $historial_empresario->telefono_nuevo = $request->input('telefono');
                    $historial_empresario->direccion_nueva = $request->input('direccion');
                    $historial_empresario->pedido_id = $pedido->id;
                    $historial_empresario->user_id = Auth::user()->id;
                    $historial_empresario->save();
                    $guia = $pedido->guias()->orderBy('id', 'DESC')->first();
                    $operador_logistico = $guia->operadorLogistico;
                    $datos_cambiados = [];



					$pedido->direccion = $request->input('direccion');
                    $pedido->save();
                    $datos_cambiados['Dirección'] = $request->input('direccion');
                    $pedido->first_name = $request->input('nombres');
                    $pedido->last_name = $request->input('apellidos');
                    $pedido->email = $request->input('email');
                    $user->telefono = $request->input('telefono');
                    $user->save();
                    $pedido->save();
                    $datos_cambiados['Nombres'] = $request->input('nombres');
                    $datos_cambiados['Apellidos'] = $request->input('apellidos');
                    $datos_cambiados['Email'] = $request->input('email');
                    $datos_cambiados['Teléfono'] = $request->input('telefono');
                    $correo = new Correo();
                    $correo->titulo = 'Cambio información remitente';
                    $correo->mensaje = view('mail.contenidos.cambio_info_empresario_ol')
                        ->with('datos_cambiados', $datos_cambiados)
                        ->with('guia', $guia)
                        ->with('operador_logistico', $operador_logistico)
                        ->render();
                    $correo->asunto = 'Solicitud soporte Fuxion';


					if ($operador_logistico->nombre == 'Deprisa') {
                        $user_mail = new User();
                        $user_mail->email = 'INHOUSEPROLIFE@GMAIL.COM';
						$user_mail_2 = new User();
                        $user_mail_2->email = 'mary.giraldo@avianca.com';
						$user_mail_3 = new User();
                        $user_mail_3->email = 'gmambuscay@fuxion.net';
						$user_mail_4 = new User();
                        $user_mail_4->email = 'dbernal@fuxion.net';
                        $users = collect([$user_mail, $user_mail_2, $user_mail_3, $user_mail_4]);
                    } else if ($operador_logistico->nombre == 'Servientrega') {
                        $user_mail = new User();
                        $user_mail->email = 'canal.corporativo@servientrega.com';
						$user_mail_2 = new User();
                        $user_mail_2->email = 'gmambuscay@fuxion.net';
						$user_mail_3 = new User();
                        $user_mail_3->email = 'dbernal@fuxion.net';
                        $users = collect([$user_mail, $user_mail_2, $user_mail_3]);
                    }


					if (isset($users) && count($users)) {
                        Mail::to($users)->send(new PlantillaCorreo($correo));
                    }
                    DB::commit();
                }
                return ['success'=>true];
            }
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }
    public function guardarFacturaKit(Request $request){
        $rules = [
            'factura_kit'=>'required|max:150',
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'factura_kit.required'=>'El campo No. Factura Kit es obligatorio.',
            'factura_kit.max'=>'El campo No. Factura Kit debe contener 150 caracteres como máximo.',
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $factura_kit = new FacturaKit();
        $factura_kit->numero = $request->input('factura_kit');
        $factura_kit->empresario_id = $pedido->empresario->id;
        $factura_kit->user_id = Auth::user()->id;
        $factura_kit->save();
        $pedido_estado = Pedido::segunEstadoActual()->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        if($pedido_estado->estado_pedido_id == $estado_pendiente->id && $pedido_estado->razon_estado == 'Pendiente por kit') {
            $pedido->estadosPedidos()->save($estado_pendiente, ['user_id' => Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Factura kit';
            $reporte_soporte_empresario->no_factura = $factura_kit->numero;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
    public function guardarFletePedido(Request $request){
        $rules = [
            'factura_flete'=>'required|max:150',
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'factura_flete.required'=>'El campo N0. Factura flete es obligatorio.',
            'factura_flete.max'=>'El campo N0. Factura flete debe debe contener 150 caracteres como máximo.',
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido_estado = Pedido::segunEstadoActual()->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        if($pedido_estado->estado_pedido_id == $estado_pendiente->id && ($pedido_estado->razon_estado == 'Pendiente por flete' || $pedido_estado->razon_estado == 'Carga a SAP')) {
            $flete = new FacturaFlete();
            $flete->numero = $request->input('factura_flete');
            $flete->pedido_id = $pedido->id;
            $flete->user_id = Auth::user()->id;
            $flete->save();
            $pedido->estadosPedidos()->save($estado_pendiente,['user_id'=>Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Factura flete';
            $reporte_soporte_empresario->no_factura = $flete->numero;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
    public function entregadoTienda(Request $request){
        $rules = [
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
		
		$this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido_estado = Pedido::segunEstadoActual()->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        $estado_entregado_tienda = EstadoPedido::where('nombre','Entregado en Tienda')->first();
        if($estado_entregado_tienda && $pedido_estado->estado_pedido_id == $estado_pendiente->id && ($pedido_estado->razon_estado == 'Pendiente por flete' || $pedido_estado->razon_estado == 'Pendiente por pedido'
                || $pedido_estado->razon_estado == 'Pendiente por productos' || $pedido_estado->razon_estado == 'Pendiente por kit')) {
            $pedido->estadosPedidos()->save($estado_entregado_tienda,['user_id'=>Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Entregado en tienda';
            $reporte_soporte_empresario->no_factura = null;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
    public function actualizarPendienteProducto(Request $request){
        $rules = [
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido->save();
        $pedido_estado = Pedido::segunEstadoActual()->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        if((Auth::user()->rol->nombre == 'Bodega' || Auth::user()->rol->nombre == 'Logistica') && $pedido_estado->estado_pedido_id == $estado_pendiente->id && $pedido_estado->razon_estado == 'Pendiente por productos') {
            $pedido->estadosPedidos()->save($estado_pendiente, ['user_id' => Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Pendiente por producto';
            $reporte_soporte_empresario->no_factura = null;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
    public function actualizarAnuladoSoporte(Request $request){
        $rules = [
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido->save();
        $pedido_estado = Pedido::segunEstadoActual()
            ->join('estados_pedidos','historial_estados_pedidos.estado_pedido_id','=','estados_pedidos.id')
            ->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*','estados_pedidos.nombre','estados_pedidos.asignacion_corte','estados_pedidos.no_asignacion_corte')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_anulado_soporte = EstadoPedido::where('nombre','Anulado soporte')->first();
        if( $estado_anulado_soporte &&
            Auth::user()->rol->nombre == 'Soporte' &&
            (
                $pedido_estado->asignacion_corte == 'si'
                || ($pedido_estado->no_asignacion_corte == 'si' &&
                    (
                        $pedido_estado->razon_estado == 'Pendiente por kit'
                        || $pedido_estado->razon_estado == 'Pendiente por flete'
                        || $pedido_estado->razon_estado == 'Pendiente por productos'
                        || $pedido_estado->razon_estado == 'Pendiente por numero de guía'
                    )
                )
            )
        ) {
            $pedido->estadosPedidos()->save($estado_anulado_soporte, ['user_id' => Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Anulado soporte';
            $reporte_soporte_empresario->no_factura = null;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
    public function actualizarAnulado(Request $request){
        $rules = [
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido->save();
        $pedido_estado = Pedido::segunEstadoActual()
            ->join('estados_pedidos','historial_estados_pedidos.estado_pedido_id','=','estados_pedidos.id')
            ->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*','estados_pedidos.nombre','estados_pedidos.asignacion_corte','estados_pedidos.no_asignacion_corte')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_anulado = EstadoPedido::where('nombre','Anulado')->first();
        if($estado_anulado && Auth::user()->rol->nombre == 'Logistica' && $pedido_estado->nombre == 'Anulado soporte') {
            $pedido->estadosPedidos()->save($estado_anulado, ['user_id' => Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Anulado logística';
            $reporte_soporte_empresario->no_factura = null;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
    public function guardarFleteDevolucion(Request $request){
        $rules = [
            'factura_flete'=>'required|max:150',
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'factura_flete.required'=>'El campo N0. Factura flete es obligatorio.',
            'factura_flete.max'=>'El campo N0. Factura flete debe debe contener 150 caracteres como máximo.',
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido_estado = Pedido::segunEstadoActual()->where('pedidos.id',$pedido->id)
            ->join('estados_pedidos','historial_estados_pedidos.estado_pedido_id','=','estados_pedidos.id')
            ->select('estados_pedidos.*')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        if($pedido_estado->nombre == 'Cargado en sap') {
            $flete = new FacturaFlete();
            $flete->numero = $request->input('factura_flete');
            $flete->pedido_id = $pedido->id;
            $flete->user_id = Auth::user()->id;
            $flete->save();
            $pedido->estadosPedidos()->save($estado_pendiente,['user_id'=>Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Flete devolución';
            $reporte_soporte_empresario->no_factura = $flete->numero;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }else{
            return response(['error'=>['Para realizar el registro de una factura de flete por devolución el pedido debe estar en estado "Cargado en sap".']],422);
        }
        return ['success'=>true];
    }
    public function guardarPendientePedido(Request $request){
        $rules = [
            'factura_pedido'=>'required|max:150',
            'pedido'=>'required|exists:pedidos,id',
        ];
        $mensajes = [
            'factura_pedido.required'=>'El campo N0. Factura pedido es obligatorio.',
            'factura_pedido.max'=>'El campo N0. Factura pedido debe debe contener 150 caracteres como máximo.',
            'pedido.required'=>'La información enviada es incorrecta.',
            'pedido.exists'=>'La información enviada es incorrecta.',
        ];
        $this->validate($request,$rules,$mensajes);
        $pedido = Pedido::find($request->input('pedido'));
        $pedido_estado = Pedido::segunEstadoActual()->where('pedidos.id',$pedido->id)->select('historial_estados_pedidos.*')->first();
        //se cambia el estado a pendiente con razón de estado null
        $estado_pendiente = EstadoPedido::where('no_asignacion_corte','si')->first();
        if($pedido_estado->estado_pedido_id == $estado_pendiente->id && ($pedido_estado->razon_estado == 'Pendiente por pedido')) {
            $factura_pedido = new FacturaPedido();
            $factura_pedido->numero = $request->input('factura_pedido');
            $factura_pedido->pedido_id = $pedido->id;
            $factura_pedido->save();
            $pedido->estadosPedidos()->save($estado_pendiente,['user_id'=>Auth::user()->id]);
            $reporte_soporte_empresario = new ReporteSoporteEmpresario();
            $reporte_soporte_empresario->fecha = date('Y-m-d H:i:s');
            $reporte_soporte_empresario->orden = $pedido->orden_id;
            $reporte_soporte_empresario->accion = 'Pendiente pedido';
            $reporte_soporte_empresario->no_factura = $factura_pedido->numero;
            $reporte_soporte_empresario->usuario = Auth::user()->fullName();
            $reporte_soporte_empresario->save();
        }
        return ['success'=>true];
    }
}