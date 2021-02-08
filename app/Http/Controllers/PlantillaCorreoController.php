<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestBodega;
use FuxionLogistic\Http\Requests\RequestPlantillaCorreo;
use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\PlantillaCorreo;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class PlantillaCorreoController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 9;

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
        return view('plantilla_correo/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(){
        $plantillas_correo = PlantillaCorreo::all();

        $table = Datatables::of($plantillas_correo);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($row) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="'. url('/plantilla-correo/editar').'/'. $row->id . '" class="btn btn-xs btn-primary margin-2" ><i class="white-text fa fa-pencil-square-o"></i></a>';
            }
            if(Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador)) {
                $opc .= '<a href="#!" data-plantilla-correo="'.$row->id.'" class="btn btn-xs btn-danger margin-2 btn-eliminar-plantilla-correo" data-toggle="modal" data-target="#modal-eliminar-plantilla-correo"><i class="white-text fa fa-trash"></i></a>';
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
        return view('plantilla_correo/crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(RequestPlantillaCorreo $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $plantilla_correo = new PlantillaCorreo();
        $plantilla_correo->fill($request->all());
        $plantilla_correo->save();

        return ['success'=>true];
    }

    public function editar($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');
        $plantilla_correo = PlantillaCorreo::find($id);
        if(!$plantilla_correo)
            return redirect('/');


        return view('plantilla_correo/editar')->with('privilegio_superadministrador',$this->privilegio_superadministrador)
            ->with('plantilla_correo',$plantilla_correo);
    }

    public function actualizar(RequestPlantillaCorreo $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $plantilla_correo = PlantillaCorreo::find($request->id);
        if(!$plantilla_correo)return response(['error'=>['La información enviada es incorrecta']],422);

        $plantilla_correo->fill($request->all());
        $plantilla_correo->save();

      Session::push('msj_success','La información de la plantilla de correo ha sido actualizada con éxito.');
        return ['success'=>true];
    }

    public function borrar(Request $request){
        if($request->has('id')){
            $plantilla_correo = PlantillaCorreo::find($request->input('id'));
            if($plantilla_correo){
                $plantilla_correo->delete();
            }

            return ['success'=>true];
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }
}
