<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestMallaCobertura;
use FuxionLogistic\Http\Requests\RequestOperadorLogistico;
use FuxionLogistic\Http\Requests\UsuarioRequest;
use FuxionLogistic\Mail\NuevaCuenta;
use FuxionLogistic\Models\Archivo;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\MallaCobertura;
use FuxionLogistic\Models\OperadorLogistico;
use FuxionLogistic\Models\Ubicacion;
use FuxionLogistic\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\Datatables\Facades\Datatables;

class MallaCoberturaController extends Controller
{

    public $privilegio_superadministrador = true;
    protected $modulo_id = 8;

    function __construct()
    {
        $this->middleware('permisoModulo:'.$this->modulo_id.',' . $this->privilegio_superadministrador,['except'=>['']]);
    }

    public function index(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        return view('malla_cobertura.index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function crear(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return redirect('/');

        return view('malla_cobertura.crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(RequestMallaCobertura $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        DB::beginTransaction();

        $malla_cobertura = new MallaCobertura($request->all());
        $malla_cobertura->operador_logistico_id = $request->input('operador_logistico');
        $malla_cobertura->save();

        DB::commit();

        return ['success'=>true];
    }

    public function editar($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');

        $malla_cobertura = MallaCobertura::select('mallas_cobertura.*','operadores_logisticos.id as operador_logistico')
            ->join('operadores_logisticos','mallas_cobertura.operador_logistico_id','=','operadores_logisticos.id')
            ->where('mallas_cobertura.id',$id)->first();
        if(!$malla_cobertura) return redirect('/');


        return view('malla_cobertura.editar')
            ->with('malla_cobertura',$malla_cobertura)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function actualizar(RequestMallaCobertura $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized']],401);

        DB::beginTransaction();

        $malla_cobertura = MallaCobertura::find($request->input('id'));
        if(!$malla_cobertura)return response(['error'=>['La información enviada es incorrecta']],422);

        $malla_cobertura->fill($request->all());
        if($request->has('operador_logistico'))
            $malla_cobertura->operador_logistico_id = $request->input('operador_logistico');

        $malla_cobertura->save();
        DB::commit();
        return ['success'=>true];
    }

    public function borrar(Request $request){
        if($request->has('id')){
            $malla_cobertura = MallaCobertura::find($request->input('id'));
            if($malla_cobertura){
                $malla_cobertura->delete();
            }

            return ['success'=>true];
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function lista(){
        $mallas_cobertura = MallaCobertura::select('mallas_cobertura.*','operadores_logisticos.nombre as operador_logistico')
            ->join('operadores_logisticos','mallas_cobertura.operador_logistico_id','=','operadores_logisticos.id')
            ->orderBy('mallas_cobertura.created_at', 'ASC')->get();

        $table = Datatables::of($mallas_cobertura);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($r) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="' . url('/malla-cobertura/editar') .'/'. $r->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="white-text fa fa-pencil-square-o"></i></a>';
            }

            if(Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" data-malla-cobertura="'.$r->id.'" class="btn btn-xs btn-danger margin-2 btn-eliminar-malla-cobertura" data-toggle="modal" data-target="#modal-eliminar-malla-cobertura"><i class="white-text fa fa-trash"></i></a>';
            }

            return $opc;

        })->rawColumns(['opciones']);

        if(!Auth::user()->tieneFunciones($this->modulo_id,[2,3],false,$this->privilegio_superadministrador))$table->removeColumn('opciones');

        $table = $table->make(true);
        return $table;
    }

    public function importar(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,5,$this->privilegio_superadministrador))
            return redirect('/');
        return view('malla_cobertura/importar')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardarImportacion(Request $request){

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

        Excel::load($request->file('archivo'),function ($reader) use (&$error,&$complete){
            $results = $reader->all();
            DB::beginTransaction();
            //dd($results);
            $i = 2;
            foreach ($results as $row){

                //los campos inicio y fin son obligatorios
                if(!$row->origen || !$row->destino || !$row->tiempo_de_entrega || !$row->operador_logistico){
                    $error = 'Todos los campos son obligatorios son obligatorios. Error en linea #'.$i;
                    $complete = false;
                    return false;
                }

               $malla_destino = MallaCobertura::where('destino',$row->destino)->count();
                if($malla_destino){
                    $error = 'Ya existe un destino con el nombre '.$row->destino.'. Error en linea #'.$i;
                    $complete = false;
                    return false;
                }

                $operador_logistico = OperadorLogistico::where('nombre',$row->operador_logistico)->first();
                if(!$operador_logistico){
                    $error = 'No se ha encontrado ningún operador logístico con el nombre '.$row->operador_logistico.'. Error en linea #'.$i;
                    $complete = false;
                    return false;
                }

                $malla_cobertura = new MallaCobertura();
                $malla_cobertura->origen = $row->origen;
                $malla_cobertura->destino = $row->destino;
                $malla_cobertura->tiempo_entrega = $row->tiempo_de_entrega;
                $malla_cobertura->operador_logistico_id = $operador_logistico->id;
                $malla_cobertura->save();
                $i++;
            }
        });

        if(!$complete) {
            DB::rollBack();
            return response(['error' => [$error]], 422);
        }else {
            DB::commit();
            return ['success' => true];
        }
    }
}
