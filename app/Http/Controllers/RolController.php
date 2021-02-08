<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\RequestRegistro;
use FuxionLogistic\Http\Requests\RequestRol;
use FuxionLogistic\Models\Registro;
use FuxionLogistic\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolController extends Controller
{
    public $privilegio_superadministrador = true;
    protected $modulo_id = 2;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permisoModulo:'.$this->modulo_id.',' . $this->privilegio_superadministrador);
    }

    /**s
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rol/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }


    public function vistaRoles()
    {
        return view('rol.lista_roles')
            ->with('roles', Rol::orderBy("nombre")->where('superadministrador','no')->get())
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function vistaPrivilegios(Request $request)
    {
        $rol = null;
        if ($request->has('rol'))
            $rol = Rol::where('superadministrador','no')->find($request->input('rol'));

        return view('rol.lista_privilegios')
            ->with('rol', $rol)
            ->with('privilegio_superadministrador', $this->privilegio_superadministrador);
    }

    public function crear(RequestRol $request){
        if (!Auth::user()->tieneFuncion($this->modulo_id, 1, $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        $rol = new Rol();
        $rol->nombre = $request->nombre;
        if(Rol::where('empresarios','si')->count()==0){
            if($request->has('empresarios') && $request->input('empresarios') == 'si')
                $rol->empresarios = 'si';
        }

        $rol->user_id = Auth::user()->id;
        $privilegios = '';
        if($request->has('privilegios')){
            if(is_array($request->input('privilegios'))){
                for ($i = 0;$i < count($request->input('privilegios')); $i++){
                    //se separa cada dato por la coma que debe traer para identificar el módulo y la funcion ej: 2,1
                    $data = explode(',',$request->input('privilegios')[$i]);

                    if(count($data) == 2){
                        if(Auth::user()->tieneFuncion($data[0],$data[1],$this->privilegio_superadministrador)){
                            $privilegios .= '('.$request->input('privilegios')[$i].')_';
                        }
                    }else{
                        return response(['error' => ['La información enviada es incorrecta']], 422);
                    }
                }
                //se quita el ultimo '_' para que la cadena quede tipo -> (1,2)_(1,3) y no -> (1,2)_(1,3)_
                $privilegios = trim($privilegios,'_');
            }else{
                return response(['error' => ['La información enviada es incorrecta']], 422);
            }
        }
        if($privilegios != '')
            $rol->privilegios = $privilegios;

        $rol->save();
        return ['success'=>true];
    }

    public function form(Request $request){
        $rol = new Rol();
        if($request->has('rol'))$rol = Rol::find($request->input('rol'));

        return view('rol/form')->with('rol',$rol)->render();
    }

    public function editar(RequestRol $request){
        if (!Auth::user()->tieneFuncion($this->modulo_id, 2, $this->privilegio_superadministrador))
            return response(['error' => ['Unauthorized.']], 401);

        if(!$request->has('rol'))return response(['error'=>['La información envida es incorrecta']],422);

        $rol = Rol::find($request->input('rol'));

        if(!$rol)return response(['error'=>['La información envida es incorrecta']],422);

        $rol->nombre = $request->nombre;
        if(Rol::where('empresarios','si')->count()==0){
            if($request->has('empresarios') && $request->input('empresarios') == 'si')
                $rol->empresarios = 'si';
        }
        $rol->privilegios = '';
        $privilegios = '';
        if($request->has('privilegios')){
            if(is_array($request->input('privilegios'))){
                for ($i = 0;$i < count($request->input('privilegios')); $i++){
                    //se separa cada dato por la coma que debe traer para identificar el módulo y la funcion ej: 2,1
                    $data = explode(',',$request->input('privilegios')[$i]);

                    if(count($data) == 2){
                        if(Auth::user()->tieneFuncion($data[0],$data[1],$this->privilegio_superadministrador)){
                            $privilegios .= '('.$request->input('privilegios')[$i].')_';
                        }
                    }else{
                        return response(['error' => ['La información enviada es incorrecta']], 422);
                    }
                }
                //se quita el ultimo '_' para que la cadena quede tipo -> (1,2)_(1,3) y no -> (1,2)_(1,3)_
                $privilegios = trim($privilegios,'_');
            }else{
                return response(['error' => ['La información enviada es incorrecta']], 422);
            }
        }
        if($privilegios != '')
            $rol->privilegios = $privilegios;

        $rol->save();
        return ['success'=>true];
    }
}