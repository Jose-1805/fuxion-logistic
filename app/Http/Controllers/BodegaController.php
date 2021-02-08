<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestBodega;
use FuxionLogistic\Models\Bodega;
use FuxionLogistic\Models\Ciudad;
use FuxionLogistic\Models\Departamento;
use FuxionLogistic\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class BodegaController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 5;

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
        return view('bodega/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function lista(){
        $bodegas = Bodega::all();

        $table = Datatables::of($bodegas);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($row) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="'. url('/bodega/editar').'/'. $row->id . '" class="btn btn-xs btn-primary margin-2" ><i class="white-text fa fa-pencil-square-o"></i></a>';
            }

            return $opc;

        })->rawColumns(['opciones']);

        $table = $table->editColumn('ciudad', function ($r) {
            return $r->ubicacion->ciudad->nombre;
        })->rawColumns(['ciudad']);

        $table = $table->editColumn('direccion', function ($r) {
            return $r->ubicacion->stringDireccion();

        })->rawColumns(['direccion']);

        if(!Auth::user()->tieneFunciones($this->modulo_id,[2],false,$this->privilegio_superadministrador))$table->removeColumn('opciones');

        $table = $table->make(true);
        return $table;
    }

    public function crear(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return redirect('/');
        return view('bodega/crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function guardar(RequestBodega $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $ubicacion = new Ubicacion();
        $ubicacion->fill($request->all());
        $ubicacion->ciudad_id = $request->input('ciudad');
        $ubicacion->save();

        $bodega = new Bodega();
        $bodega->fill($request->all());
        $bodega->ubicacion_id = $ubicacion->id;
        $bodega->save();

        return ['success'=>true];
    }

    public function editar($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');
        $bodega = Bodega::
            select('bodegas.*',
            'ubicaciones.barrio','ubicaciones.calle','ubicaciones.carrera','ubicaciones.numero','ubicaciones.especificaciones',
            'ciudades.id as ciudad','departamentos.id as departamento','paises.id as pais'
            )
            ->join('ubicaciones','bodegas.ubicacion_id','=','ubicaciones.id')
            ->join('ciudades','ubicaciones.ciudad_id','=','ciudades.id')
            ->join('departamentos','ciudades.departamento_id','=','departamentos.id')
            ->join('paises','departamentos.pais_id','=','paises.id')
            ->find($id);
        if(!$bodega)
            return redirect('/');

        $departamentos = Departamento::where('pais_id',$bodega->pais)->pluck('nombre','id')->toArray();
        $ciudades = Ciudad::where('departamento_id',$bodega->departamento)->pluck('nombre','id')->toArray();

        return view('bodega/editar')->with('privilegio_superadministrador',$this->privilegio_superadministrador)
            ->with('bodega',$bodega)
            ->with('ciudades',$ciudades)
            ->with('departamentos',$departamentos);
    }

    public function actualizar(RequestBodega $request)
    {
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unathorized.']],401);

        $bodega = Bodega::find($request->bodega);
        if(!$bodega)return response(['error'=>['La información enviada es incorrecta']],422);

        $bodega->fill($request->all());
        $bodega->save();

        $ubicacion = $bodega->ubicacion;
        $ubicacion->fill($request->all());
        $ubicacion->ciudad_id = $request->input('ciudad');
        $ubicacion->save();
        Session::push('msj_success','La información de la bodega ha sido actualizada con éxito.');

        return ['success'=>true];
    }
}
