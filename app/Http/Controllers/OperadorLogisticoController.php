<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestOperadorLogistico;
use FuxionLogistic\Http\Requests\UsuarioRequest;
use FuxionLogistic\Mail\NuevaCuenta;
use FuxionLogistic\Models\Archivo;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\OperadorLogistico;
use FuxionLogistic\Models\Ubicacion;
use FuxionLogistic\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Facades\Datatables;

class OperadorLogisticoController extends Controller
{

    public $privilegio_superadministrador = true;
    protected $modulo_id = 7;

    function __construct()
    {
        $this->middleware('permisoModulo:'.$this->modulo_id.',' . $this->privilegio_superadministrador,['except'=>['']]);
    }

    public function index(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,4,$this->privilegio_superadministrador))
            return redirect('/');
        return view('operador_logistico.index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function crear(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return redirect('/');

        return view('operador_logistico.crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(RequestOperadorLogistico $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        DB::beginTransaction();

        $ubicacion = new Ubicacion();
        $ubicacion->fill($request->all());
        $ubicacion->ciudad_id = $request->input('ciudad');
        $ubicacion->save();

        $operador_logistico = new OperadorLogistico($request->all());
        $operador_logistico->ubicacion_id = $ubicacion->id;

        if($request->has('web_service'))
                $operador_logistico->ws = 'si';

        $operador_logistico->save();

        DB::commit();

        return ['success'=>true];
    }

    public function editar($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');

        $operador_logistico = OperadorLogistico::select('operadores_logisticos.*',
                'ubicaciones.barrio as barrio','ubicaciones.calle as calle','ubicaciones.carrera as carrera','ubicaciones.numero as numero','ubicaciones.especificaciones as especificaciones')
            ->join('ubicaciones','operadores_logisticos.ubicacion_id','=','ubicaciones.id')
            ->where('operadores_logisticos.id',$id)->first();
        if(!$operador_logistico) return redirect('/');

        $ciudades = Departamento::where('pais_id',$operador_logistico->ubicacion->ciudad->departamento->pais->id)->pluck('nombre','id')->toArray();
        $ciudades = Ciudad::where('departamento_id',$operador_logistico->ubicacion->ciudad->departamento->id)->pluck('nombre','id')->toArray();

        return view('operador_logistico.editar')
            ->with('operador_logistico',$operador_logistico)
            ->with('ciudades',$ciudades)
            ->with('departamentos',$ciudades)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function actualizar(RequestOperadorLogistico $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized']],401);

        DB::beginTransaction();

        $operador_logistico = OperadorLogistico::find($request->input('id'));
        if(!$operador_logistico)return response(['error'=>['La información enviada es incorrecta']],422);

        $ubicacion_id = $operador_logistico->ubicacion_id;
        $operador_logistico->fill($request->all());
        $operador_logistico->ubicacion_id = $ubicacion_id;
        if($request->has('web_service')) $operador_logistico->ws = 'si';
        else $operador_logistico->ws = 'no';
        $operador_logistico->save();

        $ubicacion = $operador_logistico->ubicacion;
        $ubicacion->fill($request->all());
        $ubicacion->ciudad_id = $request->input('ciudad');
        $ubicacion->save();

        DB::commit();
        return ['success'=>true];
    }

    public function borrar(Request $request){
        if($request->has('id')){
            $operador_logistico = OperadorLogistico::find($request->input('id'));
            if($operador_logistico){
                $operador_logistico->delete();
            }

            return ['success'=>true];
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function lista(){
        $operadores_logisticos = OperadorLogistico::select('operadores_logisticos.*','ciudades.nombre as ciudad')
            ->join('ubicaciones','operadores_logisticos.ubicacion_id','=','ubicaciones.id')
            ->join('ciudades','ubicaciones.ciudad_id','=','ciudades.id')
            ->orderBy('operadores_logisticos.created_at', 'ASC')->get();

        $table = Datatables::of($operadores_logisticos);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($r) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="' . url('/operador-logistico/editar') .'/'. $r->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="white-text fa fa-pencil-square-o"></i></a>';
            }

            if(Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" data-operador-logistico="'.$r->id.'" class="btn btn-xs btn-danger margin-2 btn-eliminar-operador-logistico" data-toggle="modal" data-target="#modal-eliminar-operador-logistico"><i class="white-text fa fa-trash"></i></a>';
            }

            return $opc;

        })->rawColumns(['opciones']);

        if(!Auth::user()->tieneFunciones($this->modulo_id,[2,3],false,$this->privilegio_superadministrador))$table->removeColumn('opciones');

        $table = $table->make(true);
        return $table;
    }

    public function nombresRegiones(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');

        $operadores_logisticos = OperadorLogistico::all();
        return view('operador_logistico.nombres_regiones')
            ->with('operadores_logisticos',$operadores_logisticos)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function listaDepartamentos(Request $request)
    {
        $departamentos = Departamento::select(
            'departamentos.id',
            'departamentos.nombre as departamento'
        )->get();

        $table = Datatables::of($departamentos);

        $operadores_logisticos = OperadorLogistico::all();
        foreach ($operadores_logisticos as $ol){
            $table->editColumn($ol->nombre,function ($row) use ($ol){
                return $row->nombreParaOL($ol->id);
            })->rawColumns([$ol->nombre]);
        }
        $table->editColumn('opciones',function ($row){
            return '<a href="#!" class="btn btn-xs btn-primary btn-nombre-departamento-ol" data-departamento="'.$row->id.'" title="Editar"><i class="white-text fa fa-pencil-square-o"></i></a>';;
        })->rawColumns(['opciones']);

        $table = $table->make(true);
        return $table;
    }

    public function formNombresDepartamentos(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['La información enviada es incorrecta']],422);

        if($request->has('departamento')){
            $departamento = Departamento::find($request->input('departamento'));
            if($departamento){
                $o_ls = OperadorLogistico::all();
                $operadores_logisticos = [];
                foreach ($o_ls as $ol){
                    $ol->departamento = $departamento->nombreParaOL($ol->id);
                    $operadores_logisticos[] = $ol;
                }

                /*select('operadores_logisticos.*','operadores_logisticos_departamentos.nombre as departamento')
                    ->leftJoin('operadores_logisticos_departamentos','operadores_logisticos.id','=','operadores_logisticos_departamentos.operador_logistico_id')
                    ->leftJoin('departamentos','operadores_logisticos_departamentos.departamento_id','=','departamentos.id')
                    ->where('departamentos.id',$departamento->id)
                    ->get();*/

                return view('operador_logistico.nombres_regiones.form_departamentos')
                    ->with('departamento',$departamento)
                    ->with('operadores_logisticos',$operadores_logisticos)->render();
            }
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function guardarNombresDepartamentos(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['La información enviada es incorrecta']],422);

        if($request->has('departamento')){
            $departamento = Departamento::find($request->input('departamento'));
            if($departamento) {
                $sql = 'DELETE FROM operadores_logisticos_departamentos WHERE departamento_id = ' . $departamento->id;
                DB::beginTransaction();
                DB::statement($sql);

                $operadores_logisticos = OperadorLogistico::all();
                foreach ($operadores_logisticos as $ol){
                    if($request->has('ol_'.$ol->id)){
                        $departamento->operadoresLogisticos()->save($ol,['nombre'=>$request->input('ol_'.$ol->id)]);
                    }
                }
                DB::commit();
                return ['success'=>true];
            }
        }

        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function listaCiudades(Request $request)
    {
        if($request->has('departamento')) {
            $departamento = Departamento::find($request->input('departamento'));
            if($departamento) {
                $ciudades = $departamento->ciudades()->select(
                    'ciudades.id',
                    'ciudades.nombre as ciudad'
                )->get();

                $table = Datatables::of($ciudades);

                $operadores_logisticos = OperadorLogistico::all();
                foreach ($operadores_logisticos as $ol) {
                    $table->editColumn($ol->nombre, function ($row) use ($ol) {
                        return $row->nombreParaOL($ol->id);
                    })->rawColumns([$ol->nombre]);
                }
                $table->editColumn('opciones', function ($row) {
                    return '<a href="#!" class="btn btn-xs btn-primary btn-nombre-ciudades-ol" data-ciudad="' . $row->id . '" title="Editar"><i class="white-text fa fa-pencil-square-o"></i></a>';;
                })->rawColumns(['opciones']);

                $table = $table->make(true);
                return $table;
            }
        }
    }

    public function formNombresCiudades(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['La información enviada es incorrecta']],422);

        if($request->has('ciudad')){
            $ciudad = Ciudad::find($request->input('ciudad'));
            if($ciudad){
                $o_ls = OperadorLogistico::all();
                $operadores_logisticos = [];
                foreach ($o_ls as $ol){
                    $ol->ciudad = $ciudad->nombreParaOL($ol->id);
                    $operadores_logisticos[] = $ol;
                }

                /*select('operadores_logisticos.*','operadores_logisticos_ciudades.nombre as ciudad')
                    ->leftJoin('operadores_logisticos_ciudades','operadores_logisticos.id','=','operadores_logisticos_ciudades.operador_logistico_id')
                    ->leftJoin('ciudades','operadores_logisticos_ciudades.ciudad_id','=','ciudades.id')
                    ->where('ciudades.id',$ciudad->id)
                    ->get();*/

                return view('operador_logistico.nombres_regiones.form_ciudades')
                    ->with('ciudad',$ciudad)
                    ->with('operadores_logisticos',$operadores_logisticos)->render();
            }
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function guardarNombresCiudades(Request $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['La información enviada es incorrecta']],422);

        if($request->has('ciudad')){
            $ciudad = Ciudad::find($request->input('ciudad'));
            if($ciudad) {
                $sql = 'DELETE FROM operadores_logisticos_ciudades WHERE ciudad_id = ' . $ciudad->id;
                DB::beginTransaction();
                DB::statement($sql);

                $operadores_logisticos = OperadorLogistico::all();
                foreach ($operadores_logisticos as $ol){
                    if($request->has('ol_'.$ol->id)){
                        $ciudad->operadoresLogisticos()->save($ol,['nombre'=>$request->input('ol_'.$ol->id)]);
                    }
                }
                DB::commit();
                return ['success'=>true];
            }
        }

        return response(['error'=>['La información enviada es incorrecta']],422);
    }
}
