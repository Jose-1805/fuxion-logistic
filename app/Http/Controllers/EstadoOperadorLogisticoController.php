<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestBodega;
use FuxionLogistic\Http\Requests\RequestEstadoOperadorLogistico;
use FuxionLogistic\Http\Requests\RequestEstadoPedido;
use FuxionLogistic\Http\Requests\RequestPlantillaCorreo;
use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\EstadoOperadorLogistico;
use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\OperadorLogistico;
use FuxionLogistic\Models\PlantillaCorreo;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class EstadoOperadorLogisticoController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 11;

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
        return view('estado_operador_logistico/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(){
        $estados_operadores_logisticos = EstadoOperadorLogistico::select('estados_operadores_logisticos.*','plantillas_correos.nombre as plantilla_correo','estados_pedidos.nombre as estado_pedido')
            ->leftJoin('plantillas_correos','estados_operadores_logisticos.plantilla_correo_id','=','plantillas_correos.id')
            ->leftJoin('estados_pedidos','estados_operadores_logisticos.cambio_estado_pedido_id','=','estados_pedidos.id');


        $table = Datatables::of($estados_operadores_logisticos);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($row) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="'. url('/estado-operador-logistico/editar').'/'. $row->id . '" class="btn btn-xs btn-primary margin-2" ><i class="white-text fa fa-pencil-square-o"></i></a>';
            }
            if(Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" data-estado-operador-logistico="'.$row->id.'" class="btn btn-xs btn-danger margin-2 btn-eliminar-estado-operador-logistico" data-toggle="modal" data-target="#modal-eliminar-estado-operador-logistico"><i class="white-text fa fa-trash"></i></a>';
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
        return view('estado_operador_logistico/crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(RequestEstadoOperadorLogistico $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        DB::beginTransaction();
        $estado_operador_logistico = new EstadoOperadorLogistico();
        $estado_operador_logistico->fill($request->all());
        if($request->has('notificacion_push')){
            $estado_operador_logistico->notificacion_push = 'si';
        }

        $estado_operador_logistico->correos_destinatarios = null;
        if($request->has('notificacion_correo')){
            $estado_operador_logistico->notificacion_correo = 'si';
            $estado_operador_logistico->plantilla_correo_id = $request->input('plantilla_correo');
            $correos = explode(';',str_replace(' ','',$request->input('correos_destinatarios')));
            foreach ($correos as $correo){
                if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    return response(['error'=>['Formato de correo no válido ('.$correo.'). Recuerde ingresar todos los correos separados por (;)']],422);
                }
            }
            $estado_operador_logistico->correos_destinatarios = str_replace(' ','',$request->input('correos_destinatarios'));

        }

        if($request->has('estado_pedido')){
            $estado_operador_logistico->cambio_estado_pedido_id = $request->estado_pedido;
        }

        $estado_operador_logistico->save();

        $operadores_logisticos = OperadorLogistico::all();
        foreach ($operadores_logisticos as $ol){
            //si se ingreso el nombre para el operador logistico
            //se relaciona
            if($request->has('nombre_'.$ol->id)){
                $estado_operador_logistico->operadoresLogisticos()->save($ol,['nombre'=>$request->input('nombre_'.$ol->id)]);
            }
        }
        DB::commit();
        return ['success'=>true];
    }

    public function editar($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');
        $estado_operador_logistico = EstadoOperadorLogistico::select('estados_operadores_logisticos.*','plantillas_correos.id as plantilla_correo','estados_pedidos.id as estado_pedido')
            ->leftJoin('plantillas_correos','estados_operadores_logisticos.plantilla_correo_id','=','plantillas_correos.id')
            ->leftJoin('estados_pedidos','estados_operadores_logisticos.cambio_estado_pedido_id','=','estados_pedidos.id')
            ->where('estados_operadores_logisticos.id',$id)
            ->first();
        if(!$estado_operador_logistico)
            return redirect('/');

        return view('estado_operador_logistico/editar')->with('privilegio_superadministrador',$this->privilegio_superadministrador)
            ->with('estado_operador_logistico',$estado_operador_logistico);
    }

    public function actualizar(RequestEstadoOperadorLogistico $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $estado_operador_logistico = EstadoOperadorLogistico::find($request->id);
        if(!$estado_operador_logistico)return response(['error'=>['La información enviada es incorrecta']],422);

        DB::beginTransaction();

        $estado_operador_logistico->fill($request->all());

        $estado_operador_logistico->notificacion_push = 'no';
        $estado_operador_logistico->notificacion_correo = 'no';
        $estado_operador_logistico->plantilla_correo_id = null;
        $estado_operador_logistico->cambio_estado_pedido_id = null;
        if($request->has('notificacion_push')){
            $estado_operador_logistico->notificacion_push = 'si';
        }

        $estado_operador_logistico->correos_destinatarios = null;
        if($request->has('notificacion_correo')){
            $estado_operador_logistico->notificacion_correo = 'si';
            $estado_operador_logistico->plantilla_correo_id = $request->input('plantilla_correo');

            $correos = explode(';',str_replace(' ','',$request->input('correos_destinatarios')));
            foreach ($correos as $correo){
                if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                    return response(['error'=>['Formato de correo no válido ('.$correo.'). Recuerde ingresar todos los correos separados por (;)']],422);
                }
            }
            $estado_operador_logistico->correos_destinatarios = str_replace(' ','',$request->input('correos_destinatarios'));
        }

        if($request->has('estado_pedido')){
            $estado_operador_logistico->cambio_estado_pedido_id = $request->estado_pedido;
        }

        $estado_operador_logistico->save();

        DB::statement('UPDATE nombres_estados_operadores_logisticos SET nombre = NULL WHERE estado_operador_logistico_id = '.$estado_operador_logistico->id);

        $operadores_logisticos = OperadorLogistico::all();
        foreach ($operadores_logisticos as $ol){
            //si se ingreso el nombre para el operador logistico
            //se relaciona
            if($request->has('nombre_'.$ol->id)){
                if(!$estado_operador_logistico->operadoresLogisticos()->where('operadores_logisticos.id',$ol->id)->first()) {
                    $estado_operador_logistico->operadoresLogisticos()->save($ol, ['nombre' => $request->input('nombre_' . $ol->id)]);
                }else{
                    //$estado_operador_logistico->operadoresLogisticos()->sync($ol, ['nombre' => $request->input('nombre_' . $ol->id)]);
                    DB::statement('UPDATE nombres_estados_operadores_logisticos SET nombre = "'.$request->input('nombre_' . $ol->id).'" WHERE estado_operador_logistico_id = '.$estado_operador_logistico->id.' AND operador_logistico_id = '.$ol->id);
                }
            }
        }
        DB::commit();
        Session::push('msj_success','La información del estado de pedido ha sido actualizada con éxito.');
        return ['success'=>true];
    }

    public function borrar(Request $request){
        if($request->has('id')){
            $estado_operador_logistico = EstadoOperadorLogistico::find($request->input('id'));
            if($estado_operador_logistico){
                $estado_operador_logistico->delete();
            }

            return ['success'=>true];
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }
}
