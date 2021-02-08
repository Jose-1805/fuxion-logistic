<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if(Auth::guest()) {
        return view('welcome');
    }else{
        return redirect('/home');
    }
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuario/validar-cuenta/{id}/{token}', 'UsuarioController@validarCuenta')->middleware('guest');
Route::post('/usuario/validar-cuenta', 'UsuarioController@validarCuentaSend')->middleware('guest');
Route::get('/usuario/password-empresario/{id}/{token}', 'UsuarioController@passwordEmpresario')->middleware('guest');
Route::post('/usuario/password-empresario', 'UsuarioController@passwordEmpresarioSend')->middleware('guest');

/**
 * IMAGENES DEL SISTEMA
 */
Route::get('/archivo/{path}',function ($path){
    $path = storage_path() .'/'. str_replace('-','/', $path);
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::group(['middleware' => 'auth'], function () {
    /**
     * MODULOS Y FUNCIONES
     */
    Route::group(['prefix' => 'modulos-funciones'],function (){
        Route::get('/', 'ModulosFuncionesController@index');
        Route::post('/vista-modulos', 'ModulosFuncionesController@vistaModulos');
        Route::post('/vista-funciones', 'ModulosFuncionesController@vistaFunciones');
        Route::post('/actualizar-relacion', 'ModulosFuncionesController@actualizarRelacion');
        Route::post('/nuevo-modulo', 'ModulosFuncionesController@nuevoModulo');
        Route::post('/nueva-funcion', 'ModulosFuncionesController@nuevaFuncion');
        Route::post('form-modulo', 'ModulosFuncionesController@formModulo');
        Route::post('editar-modulo', 'ModulosFuncionesController@editarModulo');
        Route::post('form-funcion', 'ModulosFuncionesController@formFuncion');
        Route::post('editar-funcion', 'ModulosFuncionesController@editarFuncion');
    });

    /**
     * ROLES DEL SISTEMA
     */
    Route::group(['prefix' => 'rol'],function (){
        Route::get('/', 'RolController@index');
        Route::post('vista-roles', 'RolController@vistaRoles');
        Route::post('vista-privilegios', 'RolController@vistaPrivilegios');
        Route::post('crear', 'RolController@crear');
        Route::post('form', 'RolController@form');
        Route::post('editar', 'RolController@editar');
    });

    /**
     * USUARIOS DEL SISTEMA
     */
    Route::group(['prefix' => 'usuario'],function (){
        Route::get('/', 'UsuarioController@index');
        Route::get('/lista', 'UsuarioController@lista');
        Route::get('/create', 'UsuarioController@create');
        Route::post('/store', 'UsuarioController@store');
        Route::get('/edit/{id}', 'UsuarioController@edit');
        Route::post('/update', 'UsuarioController@update');
        Route::post('/delete', 'UsuarioController@delete');
    });

    /**
     * CORTES DEL SISTEMA
     */
    Route::group(['prefix' => 'corte'],function (){
        Route::get('/', 'CorteController@index');
        Route::get('/lista', 'CorteController@lista');
        Route::get('/importar', 'CorteController@importar');
        Route::post('/guardar', 'CorteController@guardar');
        Route::get('/detalle/{id}', 'CorteController@detalle');
        Route::get('/lista-pedidos-corte/{id}', 'CorteController@listaPedidosCorte');
        Route::post('/aplicar-malla-cobertura/{id}', 'CorteController@aplicarMallaCobertura');
        Route::get('/guias/{id}', 'CorteController@guias');
        Route::get('/guias-operador-logistico/{corte}/{operadorLogistico}', 'CorteController@guiasOperadorLogistico');
        Route::get('/lista-guias-operador-logistico/{corte}/{operadorLogistico}', 'CorteController@listaGuiasOperadorLogistico');
        Route::post('/reasignar-guias-operador-logistico', 'CorteController@reasignarGuiasOperadorLogistico');
        Route::get('/descarga-guias/{corte_id}/{operador_logistico_id}', 'CorteController@descargaGuias');
        Route::get('/guias-manuales/{corte_id}', 'CorteController@guiasManuales');
        Route::post('/procesar-guias-manuales', 'CorteController@procesarGuiasManuales');
        Route::post('/guias-automaticas', 'CorteController@guiasAutomaticas');
        Route::post('/eliminar', 'CorteController@eliminar');
		Route::get('/informe-productos/{corte_id}', 'CorteController@informeProductos');
    });

    /**
     * BODEGAS DEL SISTEMA
     */
    Route::group(['prefix' => 'bodega'],function (){
        Route::get('/', 'BodegaController@index');
        Route::get('/lista', 'BodegaController@lista');
        Route::get('/crear', 'BodegaController@crear');
        Route::post('/guardar', 'BodegaController@guardar');
        Route::get('/editar/{id}', 'BodegaController@editar');
        Route::post('/actualizar', 'BodegaController@actualizar');
    });

    /**
     * CLIENTE DEL SISTEMA
     */
    Route::group(['prefix' => 'empresario'],function (){
        Route::get('/', 'EmpresarioController@index');
        Route::get('/lista', 'EmpresarioController@lista');
        Route::get('/importacion-kits', 'EmpresarioController@importacionKits');
        Route::post('/importar-kits', 'EmpresarioController@importarKits');
        //Route::get('/crear', 'EmpresarioController@crear');
        //Route::post('/guardar', 'EmpresarioController@guardar');
        //Route::get('/editar/{id}', 'EmpresarioController@editar');
        //Route::post('/actualizar', 'EmpresarioController@actualizar');
    });

    /**
     * OPERADORES LOGÍSTICOS DEL SISTEMA
     */
    Route::group(['prefix' => 'operador-logistico'],function (){
        Route::get('/', 'OperadorLogisticoController@index');
        Route::get('/lista', 'OperadorLogisticoController@lista');
        Route::get('/crear', 'OperadorLogisticoController@crear');
        Route::post('/guardar', 'OperadorLogisticoController@guardar');
        Route::get('/editar/{id}', 'OperadorLogisticoController@editar');
        Route::post('/actualizar', 'OperadorLogisticoController@actualizar');
        Route::post('/borrar', 'OperadorLogisticoController@borrar');
        Route::get('/nombres-regiones', 'OperadorLogisticoController@nombresRegiones');
        Route::get('/lista-departamentos', 'OperadorLogisticoController@listaDepartamentos');
        Route::post('/form-nombres-departamentos', 'OperadorLogisticoController@formNombresDepartamentos');
        Route::post('/guardar-nombres-departamentos', 'OperadorLogisticoController@guardarNombresDepartamentos');
        Route::get('/lista-ciudades', 'OperadorLogisticoController@listaCiudades');
        Route::post('/form-nombres-ciudades', 'OperadorLogisticoController@formNombresCiudades');
        Route::post('/guardar-nombres-ciudades', 'OperadorLogisticoController@guardarNombresCiudades');
    });

    /**
     * MALLAS DE COBERTURA DEL SISTEMA
     */
    Route::group(['prefix' => 'malla-cobertura'],function (){
        Route::get('/', 'MallaCoberturaController@index');
        Route::get('/lista', 'MallaCoberturaController@lista');
        Route::get('/crear', 'MallaCoberturaController@crear');
        Route::get('/editar/{id}', 'MallaCoberturaController@editar');
        Route::post('/guardar', 'MallaCoberturaController@guardar');
        Route::post('/actualizar', 'MallaCoberturaController@actualizar');
        Route::post('/borrar', 'MallaCoberturaController@borrar');
        Route::get('/importar', 'MallaCoberturaController@importar');
        Route::post('/guardar-importacion', 'MallaCoberturaController@guardarImportacion');
    });

    /**
     * PLANTILLAS DE CORREO DEL SISTEMA
     */
    Route::group(['prefix' => 'plantilla-correo'],function (){
        Route::get('/', 'PlantillaCorreoController@index');
        Route::get('/lista', 'PlantillaCorreoController@lista');
        Route::get('/crear', 'PlantillaCorreoController@crear');
        Route::post('/guardar', 'PlantillaCorreoController@guardar');
        Route::get('/editar/{id}', 'PlantillaCorreoController@editar');
        Route::post('/actualizar', 'PlantillaCorreoController@actualizar');
        Route::post('/borrar', 'PlantillaCorreoController@borrar');
    });

    /**
     * ESTADOS DE PEDIDOS DEL SISTEMA
     */
    Route::group(['prefix' => 'estado-pedido'],function (){
        Route::get('/', 'EstadoPedidoController@index');
        Route::get('/lista', 'EstadoPedidoController@lista');
        Route::get('/crear', 'EstadoPedidoController@crear');
        Route::post('/guardar', 'EstadoPedidoController@guardar');
        Route::get('/editar/{id}', 'EstadoPedidoController@editar');
        Route::post('/actualizar', 'EstadoPedidoController@actualizar');
        Route::post('/borrar', 'EstadoPedidoController@borrar');
    });

    /**
     * ESTADOS DE PEDIDOS RELACIONADOS CON LOS OPERADORES LOGISTICOS
     */
    Route::group(['prefix' => 'estado-operador-logistico'],function (){
        Route::get('/', 'EstadoOperadorLogisticoController@index');
        Route::get('/lista', 'EstadoOperadorLogisticoController@lista');
        Route::get('/crear', 'EstadoOperadorLogisticoController@crear');
        Route::post('/guardar', 'EstadoOperadorLogisticoController@guardar');
        Route::get('/editar/{id}', 'EstadoOperadorLogisticoController@editar');
        Route::post('/actualizar', 'EstadoOperadorLogisticoController@actualizar');
        Route::post('/borrar', 'EstadoOperadorLogisticoController@borrar');
    });

    /**
     * ESTADOS DE PEDIDOS RELACIONADOS CON LOS OPERADORES LOGISTICOS
     */
    Route::group(['prefix' => 'soporte-empresario'],function (){
        Route::get('/', 'SoporteEmpresarioController@index');
        Route::get('/lista', 'SoporteEmpresarioController@lista');
        Route::post('/opciones', 'SoporteEmpresarioController@opciones');
        Route::post('/tracking', 'SoporteEmpresarioController@tracking');
        Route::post('/historial-guias', 'SoporteEmpresarioController@historialGuias');
        Route::post('/imagenes-guia', 'SoporteEmpresarioController@imagenesGuia');
        Route::post('/actualizar-empresario', 'SoporteEmpresarioController@actualizarEmpresario');
        Route::post('/guardar-factura-kit', 'SoporteEmpresarioController@guardarFacturaKit');
        Route::post('/guardar-flete-pedido', 'SoporteEmpresarioController@guardarFletePedido');
        Route::post('/entregado-tienda', 'SoporteEmpresarioController@entregadoTienda');
        Route::post('/actualizar-pendiente-producto', 'SoporteEmpresarioController@actualizarPendienteProducto');
        Route::post('/actualizar-anulado-soporte', 'SoporteEmpresarioController@actualizarAnuladoSoporte');
        Route::post('/actualizar-anulado', 'SoporteEmpresarioController@actualizarAnulado');
        Route::post('/guardar-flete-devolucion', 'SoporteEmpresarioController@guardarFleteDevolucion');
        Route::post('/guardar-pendiente-pedido', 'SoporteEmpresarioController@guardarPendientePedido');
    });

    /**
     * ESTADOS DE PEDIDOS RELACIONADOS CON LOS OPERADORES LOGISTICOS
     */
    Route::group(['prefix' => 'cargue-sap'],function (){
        Route::get('/', 'CargueSapController@index');
        Route::get('/lista', 'CargueSapController@lista');
        Route::post('/cargar', 'CargueSapController@cargar');
    });

    /**
     * REPORTES DEL SISTEMA
     */
    Route::group(['prefix' => 'reporte'],function (){
        Route::get('/', 'ReporteController@index');
        Route::get('/lista', 'ReporteController@lista');
        Route::get('/exportar', 'ReporteController@exportar');
    });

    /**
     * REPORTE DE SOPORTE A EMPRESARIO
     */
    Route::group(['prefix' => 'reporte-soporte-empresario'],function (){
        Route::get('/', 'ReporteSoporteEmpresarioController@index');
        Route::get('/lista', 'ReporteSoporteEmpresarioController@lista');
        Route::get('/exportar', 'ReporteSoporteEmpresarioController@exportar');
    });

    /**
     * HISTORIAL DE EMPRESARIOS
     */
    Route::group(['prefix' => 'historial-empresario'],function (){
        Route::get('/', 'HistorialEmpresarioController@index');
        Route::get('/lista', 'HistorialEmpresarioController@lista');
        Route::get('/exportar', 'HistorialEmpresarioController@exportar');
    });

    /**
     * CONFIGURACION DEL SISTEMA
     */
    Route::group(['prefix' => 'configuracion'],function (){
        Route::get('/', 'ConfiguracionController@index');
        Route::post('/cambiar-password', 'ConfiguracionController@cambiarPassword');
        Route::post('/desbloquear-dispositivo', 'ConfiguracionController@desbloquearDispositivo');
        Route::post('/imagen-empresario', 'ConfiguracionController@imagenEmpresario');
    });

    /**
     * REGIONES DEL SISTEMA
     */
    Route::group(['prefix' => 'region'],function (){
       Route::get('/','RegionController@index');
       Route::get('lista-departamentos','RegionController@listaDepartamentos');
       Route::get('lista-ciudades','RegionController@listaCiudades');
       Route::post('form-departamento','RegionController@formDepartamento');
       Route::post('guardar-departamento','RegionController@guardarDepartamento');
       Route::post('eliminar-departamento','RegionController@eliminarDepartamento');
       Route::post('form-ciudad','RegionController@formCiudad');
       Route::post('guardar-ciudad','RegionController@guardarCiudad');
       Route::post('eliminar-ciudad','RegionController@eliminarCiudad');
    });
});


/**
 * TAREAS DEL SISTEMA
 */
Route::group(['prefix' => 'tareas-sistema'],function (){
    Route::post('/select-departamentos', function (\Illuminate\Http\Request $request){
        $departamentos = [''=>'Seleccione un departamento']+\FuxionLogistic\Models\Departamento::pluck('nombre','id')->toArray();
        $name = 'departamento';
        if($request->has('pais')){
            $departamentos = [''=>'Seleccione un departamento']+\FuxionLogistic\Models\Departamento::where('pais_id',$request->input('pais'))->pluck('nombre','id')->toArray();
        }

        if($request->has('name'))$name = $request->input('name');

        return view('layouts.componentes.select')
            ->with('elementos',$departamentos)
            ->with('name',$name)->render();
    });
    Route::post('/select-ciudades', function (\Illuminate\Http\Request $request){
        $ciudades = [''=>'Seleccione una ciudad']+\FuxionLogistic\Models\Ciudad::pluck('nombre','id')->toArray();
        $name = 'ciudad';
        if($request->has('departamento')){
            $ciudades = [''=>'Seleccione una ciudad']+\FuxionLogistic\Models\Ciudad::where('departamento_id',$request->input('departamento'))->pluck('nombre','id')->toArray();
        }

        if($request->has('name'))$name = $request->input('name');

        return view('layouts.componentes.select')
            ->with('elementos',$ciudades)
            ->with('name',$name)->render();
    });
});

/**
* ACCESO A IMAGENES DESDE LA APP
 * Autor: Carlos Ramirez
*/

Route::get('images/{tipo}/{id}/{filename}', function ($tipo, $id, $filename)
{
    $path = storage_path() . '/app/'.$tipo.'/'.$id.'/'.$filename;

    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

/**
 *  PRUEBAS DEL SISTEMA
 */

Route::get('/guias-automaticas',function (){
    //ESTABLECE OPERADOR LOGISTICO PARA LA PRUEBA
    //CAMBIAR EL PARAMETRO NOMBRE
    $servientrega = \FuxionLogistic\Models\OperadorLogistico::where('nombre','deprisa')->first();

    //ID DEL CORTE A PROBAR
    $corte = 38;

    //FUNCION QUE HACE LA LLAMADA
    //ESTA EN EL MODELO OperadorLogistico.php linea 190
    
	$respuesta=$servientrega->enviarGuiasAutomaticas($corte);

	dd($respuesta);
	
	
});

//Route::get('/ws', 'SoapController@show');

Route::get('/prueba',function (){
   \FuxionLogistic\Models\Guia::tracking();
});

Route::get('/pruebas-novedades-deprisa',function (){
    $guias_deprisa = \FuxionLogistic\Models\Guia::select('guias.*')->join('operadores_logisticos','guias.operador_logistico_id','=','operadores_logisticos.id')
        ->where('operadores_logisticos.id','2')
        ->where('guias.id','446') //383 //446 NG
        ->get();

   
    $servientrega = \FuxionLogistic\Models\Guia::trackingServientrega($guias_deprisa);
  //  $corte = 8;
//    $servientrega->enviarGuiasAutomaticas($corte);
});


/*Route::get('/prueba-mail','v1\AutorizacionController@CorreoRecuperacion');*/



/*Route::get('registro-correo',function (){
    \FuxionLogistic\Models\Guia::tracking();
   $pedido = \FuxionLogistic\Models\Pedido::first();
   \FuxionLogistic\Models\Correo::pedidoEnColaEmpresario($pedido->empresario,$pedido);
});*/

/*Route::get('/repremundo',function (){
   $corte = \FuxionLogistic\Models\Corte::find(38);
   $corte->enviarInfoRepremundo();
});*/