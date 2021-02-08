<?php

namespace FuxionLogistic\Http\Controllers\v1;

use Illuminate\Http\Request;
use FuxionLogistic\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AutorizacionController extends Controller
{
    //
    public function index(){

        return response([ 'data' => 'Ok'] );
    }

    public function cambiarClave(Request $r){

        if(strlen($r->input("clave_nueva"))<8)
            return response(['error' => "La clave debe tener al menos 8 caracteres"],400);


        if (Hash::check($r->input("clave_anterior"), Auth::user()->password))
        {
            //echo "Coiniciden...";
            $filas = DB::update("update users set password='".Hash::make($r->input("clave_nueva"))."' where users.id='".Auth::user()->id."' ");
            //echo "Actualizados:".$filas;
            if($filas>0)
                return response(['success' => true],200);
            else
                return response(['error' => "No se pudo actualizar la clave"],400);
        }else{
            //echo "NOOO Coiniciden...";
            return response(['error' => "La clave anterior no coincide"],400);
        }

    }

    public function CorreoRecuperacion(Request $request){

        if(!$request->has('correo'))
            return response(["error" => "La información enviada es incorrecta"],400);

        $usuario = \FuxionLogistic\User::where('email',$request->input('correo'))->first();
        if(!$usuario)
            return response(["error" => "Debes ingresar un correo valido"],400);

        $cliente = $usuario->empresario;
        if($cliente){
            $usuario->generarToken(true);
            if($usuario->password){
                //se envia correo para cambiar la contraseña de usuario
                \Illuminate\Support\Facades\Mail::to($usuario)->send(new \FuxionLogistic\Mail\PasswordEmpresario($usuario));
                return response(["success" => "El correo ha sido enviado"],200);
            }else{
                $usuario->sesion_fuxion_trax = 'si';
                $usuario->save();
                //se envia correo para crear la contraseña de usuario
                \Illuminate\Support\Facades\Mail::to($usuario)->send(new \FuxionLogistic\Mail\NuevaCuenta($usuario));
                return response(["success" => "El correo de creación de cuenta de usuario ha sido enviado"],200);
            }
        }else{
            return response(["error" => "Debes ingresar un correo valido"],400);
        }
        /*if(strlen($r->input("correo"))>5){

            $coincide = DB::select("select count(*) as total from users where email='".$r->input("correo")."' ");
            //dd($coincide[0]->total);
            if($coincide[0]->total>0){
                //Enviar el correo de notificación aquí
                return response(["success" => "El correo ha sido enviado"],200);
            }
            else
                return response(["error" => "El correo no esta registrado"],400);

        }else{
            return response(["error" => "Debes ingresar un correo valido"],400);
        }*/
    }

    public function ActualizarToken(Request $r){
        $filas = DB::update("update users set token_fcm='".$r->input("token")."' where users.id='".Auth::user()->id."' ");
        //echo "Actualizados:".$filas;
        if($filas>0)
            return response(['success' => true],200);
        else
            return response(['error' => "No se actualizó el token"],400);
       // dd("Ok");
        //return  response(["error" => "No se pudo actualizar el usuario"],400);
    }

     public function IdentificarMovilId($clave){

       $dato=DB::select("select movil_id from users where id='".Auth::user()->id."'");
        $vista = "Pedidos";//Bloqueado

        if($dato[0]->movil_id==0 || $dato[0]->movil_id==NULL) {
           // echo "No hay una sesión abierta!";
            DB::statement("update users set movil_id='".$clave."' where id='".Auth::user()->id."' ");

        }
        else {
           // echo "Si hay una sesión abierta!";
            if($clave==$dato[0]->movil_id) {
                //echo "Estas en el mismo movil";
            }
            else {
               // echo "No es el mismo movil...";
                $vista= "Bloqueado";
            }
        }


       //dd($dato[0]);
        return  response(["vista" => $vista],200);

    }

    public function EliminarMovilId(){

        $total = DB::statement("update users set movil_id = NULL where id='".Auth::user()->id."' ");
        if($total>0)
            return  response(["success" => "Ok"],200);
        else
            return  response(["error" => "No se pudo eliminar el Movil ID"],400);

    }
}
