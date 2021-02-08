<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\CambioPasswordRequest;
use FuxionLogistic\Http\Requests\RequestImagenEmpresario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Zend\Diactoros\Request;

class ConfiguracionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index()
    {
        return view('configuracion/index');
    }

    public function cambiarPassword(CambioPasswordRequest $request){
        $user = Auth::user();
        if(Hash::check($request->input('password_old'),$user->password)){
            $user->password = Hash::make($request->input('password'));
            $user->save();
            return ['success'=>true];
        }else{
            return response(['error'=>['La contraseña antigua es incorrecta']],422);
        }
    }

    public function desbloquearDispositivo(Request $request){
        $user = Auth::user();
        $user->movil_id = null;
        $user->save();
        return ['success'=>true];
    }

    public function imagenEmpresario(RequestImagenEmpresario $request){
        if(Auth::user()->esSuperadministrador()) {
            if (file_exists(storage_path('app/default/0/usuario.jpg'))) {
                @unlink(storage_path('app/default/0/usuario.jpg'));
            }
            $ruta = 'app/default/0/';
            $imagen = $request->file('imagen');
            $imagen->move(storage_path($ruta), 'usuario.jpg');
            Session::push('msj_success', 'La imagen de app de empresario a sido actualizada con éxito');
            return ['success' => true];
        }
        return response(['error'=>['Unauthorized.']],401);
    }
}
