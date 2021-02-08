<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Requests\UsuarioRequest;
use FuxionLogistic\Mail\NuevaCuenta;
use FuxionLogistic\Models\Archivo;
use FuxionLogistic\Models\Correo;
use FuxionLogistic\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Facades\Datatables;

class UsuarioController extends Controller
{

    public $privilegio_superadministrador = true;
    protected $modulo_id = 3;

    function __construct()
    {
        $this->middleware('permisoModulo:'.$this->modulo_id.',' . $this->privilegio_superadministrador,['except'=>['validarCuenta','validarCuentaSend','passwordEmpresario','passwordEmpresarioSend']]);
    }

    public function index(){
        return view('usuario/index')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function create(){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return redirect('/');

        return view('usuario/crear')->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function store(UsuarioRequest $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,1,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized.']],401);
        DB::beginTransaction();
        $user = new User($request->all());
        $user->rol_id = $request->input('rol');
        $user->user_id = Auth::user()->id;
        $user->bodega_id = $request->input('bodega');

        if($request->has('web'))
            $user->sesion_web = 'si';

        if($request->has('fuxion_track'))
            $user->sesion_fuxion_track = 'si';

        if($request->has('fuxion_trax'))
            $user->sesion_fuxion_trax = 'si';

        $user->save();

        if($request->hasFile('imagen')){
            $ruta = 'imagenes/usuarios/perfil/'.$user->id;
            $imagen = $request->file('imagen');
            $nombre = $imagen->getClientOriginalName();
            $nombre = str_replace('-','_',$nombre);
            $imagen->move(storage_path($ruta),$nombre);

            $imagen_obj = new Archivo();
            $imagen_obj->nombre = $nombre;
            $imagen_obj->ubicacion = $ruta;
            $imagen_obj->save();


            $user->archivo_id = $imagen_obj->id;
            $user->save();
        }

        //se genera un token de usuario
        $user->generarToken(true);
        //se envia correo para crear la contraseña de usuario
        Mail::to($user)->send(new NuevaCuenta($user));
        DB::commit();
        return ['success'=>true];
    }

    public function edit($id){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return redirect('/');

        $usuario = User::find($id);
        if(!$usuario) return redirect('/');


        return view('usuario/editar')
            ->with('usuario',$usuario)
            ->with('privilegio_superadministrador',$this->privilegio_superadministrador);
    }

    public function update(UsuarioRequest $request){
        if(!Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador))
            return response(['error'=>['Unauthorized']],401);

        DB::beginTransaction();
        $user = User::find($request->input('id'));
        $user->tipo_identificacion = $request->input('tipo_identificacion');
        $user->identificacion = $request->input('identificacion');
        $user->nombres = $request->input('nombres');
        $user->apellidos = $request->input('apellidos');
        $user->telefono = $request->input('telefono');
        $user->fecha_nacimiento = $request->input('fecha_nacimiento');
        $user->email = $request->input('email');
        $user->genero = $request->input('genero');
        $user->rol_id = $request->input('rol');
        //$user->user_id = Auth::user()->id;
        //$user->password = Hash::make($request->input('password'));
        $user->sesion_web = 'no';
        $user->sesion_fuxion_track = 'no';
        $user->sesion_fuxion_trax = 'no';
        $user->bodega_id = $request->input('bodega');
        if($request->has('web'))
            $user->sesion_web = 'si';

        if($request->has('fuxion_track'))
            $user->sesion_fuxion_track = 'si';

        if($request->has('fuxion_trax'))
            $user->sesion_fuxion_trax = 'si';
        $user->save();

        if($request->hasFile('imagen')){

            //si la mascota tiene imagen se elimina
            $imagen_obj = $user->imagen;
            if($imagen_obj){
                $file = storage_path($imagen_obj->ubicacion.'/'.$imagen_obj->nombre);
                @unlink($file);
            }

            $ruta = 'imagenes/usuarios/perfil/'.$user->id;

            $imagen = $request->file('imagen');
            $nombre = $imagen->getClientOriginalName();
            $nombre = str_replace('-','_',$nombre);
            $imagen->move(storage_path($ruta),$nombre);

            if(!$imagen_obj)
                $imagen_obj = new Archivo();

            $imagen_obj->nombre = $nombre;
            $imagen_obj->ubicacion = $ruta;
            $imagen_obj->save();

            $user->archivo_id = $imagen_obj->id;
            $user->save();
        }
        DB::commit();
        return ['success'=>true];
    }

    public function delete(Request $request){
        if($request->has('id')){
            $user = User::find($request->input('id'));
            if($user){
                $imagen_obj = $user->imagen;
                if($imagen_obj){
                    $file = storage_path($imagen_obj->ubicacion.'/'.$imagen_obj->nombre);
                    @unlink($file);
                    $imagen_obj->delete();
                }
                $user->delete();
            }

            return ['success'=>true];
        }
        return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function lista(){
        $usuarios = User::select('users.id',DB::raw('CONCAT(users.tipo_identificacion , " " ,users.identificacion) as identificacion'),DB::raw('CONCAT(users.nombres," ",users.apellidos) as nombre'),'users.email','users.telefono','users.fecha_nacimiento','users.genero','roles.nombre as rol')
            ->join('roles','users.rol_id','=','roles.id')
            ->orderBy('users.created_at', 'ASC')->get();

        $table = Datatables::of($usuarios);//->removeColumn('id');

        $table = $table->editColumn('opciones', function ($r) {
            $opc = '';
            if(Auth::user()->tieneFuncion($this->modulo_id,2,$this->privilegio_superadministrador)) {
                $opc .= '<a href="' . url('/usuario/edit') .'/'. $r->id . '" class="btn btn-xs btn-primary margin-2" data-toggle="tooltip" data-placement="bottom" title="Editar"><i class="white-text fa fa-pencil-square-o"></i></a>';
            }

            if(Auth::user()->tieneFuncion($this->modulo_id,3,$this->privilegio_superadministrador) && $r->id != Auth::user()->id) {
                $opc .= '<a href="#!" data-user="'.$r->id.'" class="btn btn-xs btn-danger margin-2 btn-eliminar-usuario" data-toggle="modal" data-target="#modal-eliimnar-usuario"><i class="white-text fa fa-trash"></i></a>';
            }

            return $opc;

        })->rawColumns(['opciones']);

        if(!Auth::user()->tieneFunciones($this->modulo_id,[2,3],false,$this->privilegio_superadministrador))$table->removeColumn('opciones');

        $table = $table->make(true);
        return $table;
    }

    public function validarCuenta($id,$token){
        $users = User::where('token',$token)->get();
        foreach ($users as $user) {
            if ($user->id == Crypt::decryptString($id) && !$user->password) {
                return view('usuario.validar_cuenta')->with('user', $user);
            }
        }
        return redirect('/');
    }

    public function validarCuentaSend(Request $request){
        $mensajes = [
            'password.required'=>'El campo contraseña es obligatorio.',
            'password.min'=>'El campo contraseña debe contener 6 caracteres como mínimo.',
            'password.same'=>'El campo contraseña y confirmación de contraseña deben coincidir.',
            'password_confirm.required'=>'El campo confirmación de contraseña es obligatorio.',
            'password_confirm.min'=>'El campo confirmación de contraseña debe contener 6 caracteres como mínimo.'
        ];
        $this->validate($request,[
            'password'=>'required|min:6|same:password_confirm',
            'password_confirm'=>'required|min:6'
        ],$mensajes);

        $user = User::find($request->input('id'));
        if($user) {
            $user->password = Hash::make($request->input('password'));
            $user->token = null;
            $user->save();
            $data_return = ['success' => true];
            if ($user->sesion_web == 'si') {
                Auth::login($user);
                $data_return['href'] = url('/');
            }else{
                $data_return['mensaje'] = 'Su contraseña de usuario ha sido registrada con éxito, para acceder'
                .' a su información descargue la apliación móvil de FuXion Trax.';
            }
            return $data_return;
        }else{
            return response(['error'=>['La información enviada es incorrecta']],422);
        }
    }

    public function passwordEmpresario($id,$token){
        $users = User::where('token',$token)->get();
        foreach ($users as $user) {
            if ($user->id == Crypt::decryptString($id) && $user->password && $user->empresario) {
                return view('usuario.password_empresario')->with('user', $user);
            }
        }
        return redirect('/');
    }

    public function passwordEmpresarioSend(Request $request){
        $mensajes = [
            'password.required'=>'El campo contraseña es obligatorio.',
            'password.min'=>'El campo contraseña debe contener 6 caracteres como mínimo.',
            'password.same'=>'El campo contraseña y confirmación de contraseña deben coincidir.',
            'password_confirm.required'=>'El campo confirmación de contraseña es obligatorio.',
            'password_confirm.min'=>'El campo confirmación de contraseña debe contener 6 caracteres como mínimo.'
        ];
        $this->validate($request,[
            'password'=>'required|min:6|same:password_confirm',
            'password_confirm'=>'required|min:6'
        ],$mensajes);

        $user = User::find($request->input('id'));
        if($user && $user->empresario) {
            $user->password = Hash::make($request->input('password'));
            $user->token = null;
            $user->save();
            $data_return = ['success' => true];
            if ($user->sesion_web == 'si') {
                Auth::login($user);
                $data_return['href'] = url('/');
            }else{
                $data_return['mensaje'] = 'Su contraseña de usuario ha sido actualizada con éxito, para acceder'
                .' a su información descargue la apliación móvil de FuXion Trax.';
            }
            return $data_return;
        }else{
            return response(['error'=>['La información enviada es incorrecta']],422);
        }
    }
}
