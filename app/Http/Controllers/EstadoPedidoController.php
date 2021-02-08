<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestBodega;
use FuxionLogistic\Http\Requests\RequestEstadoPedido;
use FuxionLogistic\Http\Requests\RequestPlantillaCorreo;
use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\PlantillaCorreo;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class EstadoPedidoController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 10;

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
        return view('estado_pedido/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(){
        $estados_pedidos = EstadoPedido::select('estados_pedidos.*','plantillas_correos.nombre as plantilla_correo')
            ->leftJoin('plantillas_correos','estados_pedidos.plantilla_correo_id','=','plantillas_correos.id');


        $table = Datatables::of($estados_pedidos);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($row) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="'. url('/estado-pedido/editar').'/'. $row->id . '" class="btn btn-xs btn-primary margin-2" ><i class="white-text fa fa-pencil-square-o"></i></a>';
            }
            if(Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" data-estado-pedido="'.$row->id.'" class="btn btn-xs btn-danger margin-2 btn-eliminar-estado-pedido" data-toggle="modal" data-target="#modal-eliminar-estado-pedido"><i class="white-text fa fa-trash"></i></a>';
            }

            return $opc;

        })->rawColumns(['opciones']);



        if(!Auth::user()->tieneFunciones($this->modulo_id,[3,2],false,$this->privilegio_superadministrador))$table->removeColumn('opciones');

        $table = $table->make(true);
        return $table;
    }

    public function crear(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return redirect('/');
        return view('estado_pedido/crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(RequestEstadoPedido $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $no_asignacion_corte = EstadoPedido::where('no_asignacion_corte','si')->count();
        $entregado = EstadoPedido::where('pedido_entregado','si')->count();

        $estado_pedido = new EstadoPedido();
        $estado_pedido->fill($request->all());

        if(!$no_asignacion_corte) {
            $estado_pedido->no_asignacion_corte = 'si';
        }else{
            $asignacion_corte = EstadoPedido::where('asignacion_corte','si')->count();
            if(!$asignacion_corte) {
                $estado_pedido->asignacion_corte = 'si';
            }else{
                if(!$entregado){
                    $estado_pedido->pedido_entregado = 'si';
                }
            }
        }

        if($request->has('notificacion_push')){
            $estado_pedido->notificacion_push = 'si';
        }

        $estado_pedido->correos_destinatarios = null;
        if($request->has('notificacion_correo')){
            $estado_pedido->notificacion_correo = 'si';
            $estado_pedido->plantilla_correo_id = $request->input('plantilla_correo');
            $correos = explode(';',str_replace(' ','',$request->input('correos_destinatarios')));
            foreach ($correos as $correo){
                if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    return response(['error'=>['Formato de correo no válido ('.$correo.'). Recuerde ingresar todos los correos separados por (;)']],422);
                }
            }
            $estado_pedido->correos_destinatarios = str_replace(' ','',$request->input('correos_destinatarios'));
        }
        $estado_pedido->save();
        session()->push('msj_success','El estado de pedido ha sido registrado con éxito.');
        return ['success'=>true];
    }

    public function editar($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');
        $estado_pedido = EstadoPedido::select('estados_pedidos.*','plantillas_correos.id as plantilla_correo')
            ->leftJoin('plantillas_correos','estados_pedidos.plantilla_correo_id','=','plantillas_correos.id')->find($id);
        if(!$estado_pedido)
            return redirect('/');


        return view('estado_pedido/editar')->with('privilegio_superadministrador',$this->privilegio_superadministrador)
            ->with('estado_pedido',$estado_pedido);
    }

    public function actualizar(RequestEstadoPedido $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $estado_pedido = EstadoPedido::find($request->id);
        if(!$estado_pedido)return response(['error'=>['La información enviada es incorrecta']],422);

        $estado_pedido->fill($request->all());

        $estado_pedido->notificacion_push = 'no';
        $estado_pedido->notificacion_correo = 'no';
        $estado_pedido->plantilla_correo_id = null;
        if($request->has('notificacion_push')){
            $estado_pedido->notificacion_push = 'si';
        }

        $estado_pedido->correos_destinatarios = null;
        if($request->has('notificacion_correo')){
            $estado_pedido->notificacion_correo = 'si';
            $estado_pedido->plantilla_correo_id = $request->input('plantilla_correo');

            $correos = explode(';',str_replace(' ','',$request->input('correos_destinatarios')));
            foreach ($correos as $correo){
                if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    return response(['error'=>['Formato de correo no válido ('.$correo.'). Recuerde ingresar todos los correos separados por (;)']],422);
                }
            }
            $estado_pedido->correos_destinatarios = str_replace(' ','',$request->input('correos_destinatarios'));
        }
        $estado_pedido->save();

      Session::push('msj_success','La información del estado de pedido ha sido actualizada con éxito.');
        return ['success'=>true];
    }

    public function borrar(Request $request){
        if($request->has('id')){
            $estado_pedido = EstadoPedido::find($request->input('id'));
            if($estado_pedido){
                $estado_pedido->delete();
            }

            return ['success'=>true];
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }
}
