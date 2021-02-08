<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('/', function () {
            return \FuxionLogistic\User::all();
        });
    });
});



Route::post('/nueva-cuenta-empresario',function (Request $request){

    if(!$request->has('correo'))
        return ['error'=>'La informaci&oacuten enviada es incorrecta'];

    $usuario = \FuxionLogistic\User::where('email',$request->input('correo'))->first();
    if(!$usuario)
        return ['error'=>'No existe ning&uacuten usuario con el email enviado'];

    $cliente = $usuario->empresario;
    if($cliente){
        if($usuario->password){
            return ['error'=>'El empresario relacionado con la informaci&oacuten enviada ya ha registrado una contraseña'];
        }else{
            $usuario->sesion_fuxion_trax = 'si';
            $usuario->generarToken(true);
            $usuario->save();
            //se envia correo para crear la contraseña de usuario
            \Illuminate\Support\Facades\Mail::to($usuario)->send(new \FuxionLogistic\Mail\NuevaCuenta($usuario));
            return ['success'=>true];
        }
    }else{
        return ['error'=>'No existe ning&uacuten usuario con el email enviado'];
    }
});

Route::post('/cambiar-password-empresario',function (Request $request){

    if(!$request->has('correo'))
        return ['error'=>'La informaci&oacuten enviada es incorrecta'];

    $usuario = \FuxionLogistic\User::where('email',$request->input('correo'))->first();
    if(!$usuario)
        return ['error'=>'No existe ning&uacuten usuario con el email enviado'];

    $cliente = $usuario->empresario;
    if($cliente){
        if(!$usuario->password){
            return ['error'=>'El empresario relacionado con la informaci&oacuten enviada a&uacuten no ha registrado una contraseña'];
        }else{
            $usuario->generarToken(true);
            //se envia correo para cambiar la contraseña de usuario
            \Illuminate\Support\Facades\Mail::to($usuario)->send(new \FuxionLogistic\Mail\PasswordEmpresario($usuario));
            return ['success'=>true];
        }
    }else{
        return ['error'=>'No existe ning&uacuten usuario con el email enviado'];
    }
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function() {
    Route::post('subida', 'v1\UploadController@store' );
    Route::resource('cortes', 'v1\CorteController');
    Route::get('pedidos/{barcode}/{corte_id}','v1\PedidoController@getPedido');
    Route::post('setIngreso','v1\PedidoController@setIngreso');
    Route::post('setEstado','v1\PedidoController@setEstado');
    Route::get('devolucion/{barcode}','v1\PedidoController@getDevolucion');
    Route::post('factura', 'v1\FacturaController@getFactura');

    Route::resource('enviado', 'v1\EnviadoController');
    Route::post('deleteEnviado','v1\EnviadoController@deleteEnviosPorGuia');
    Route::get('autorizacion', 'v1\AutorizacionController@index');//Realiza validación rápida de credenciales
    Route::get('consolidado/{corte}', 'v1\PedidoController@getConsolidado');
    Route::get('guias/{corte}', 'v1\CorteController@getNumeroGuias');
    Route::get('guiasoperador/{operador}/{corte}', 'v1\CorteController@getGuiasPorOperadorYCorte');

    Route::get('mallacobertura/{corte}', 'v1\CorteController@aplicarMallaCobertura');//Nuevo Aplicar Malla de Cobertura
    Route::get('solicitaguias/{corte}', 'v1\CorteController@solicitaGuias');//Nuevo Solicita Guias al OL
    
    

    Route::post('actualizaoperador', 'v1\GuiaController@actualizarOperador');

    Route::get('identificamovil/{id}', 'v1\AutorizacionController@IdentificarMovilId');//Nuevo para bloqueo de dispositivo
    Route::post('cambiarclave', 'v1\AutorizacionController@cambiarClave');
    Route::post('actualizatoken', 'v1\AutorizacionController@ActualizarToken');
    Route::get('eliminamovil', 'v1\AutorizacionController@EliminarMovilId');//Nuevo para eliminar bloqueo



    Route::get('pedidosexpress/{pag}', 'v1\PedidoController@getPedidosExpress');
    Route::get('productosexpress/{pedido}', 'v1\PedidoController@getProductosExpress');
    Route::get('estadosexpress/{pedido}', 'v1\PedidoController@getEstadosExpress');
    Route::get('novedadesexpress/{pedido}', 'v1\PedidoController@getNovedadesExpress');

});


Route::group(['prefix' => 'v1'], function() {
       Route::post('recuperausuario', 'v1\AutorizacionController@CorreoRecuperacion');

});

/**
 * ESPACIO PARA PRUEBAS
 */
Route::post('/prueba-api',function (Request $request){
    dd($request->isXmlHttpRequest());
});