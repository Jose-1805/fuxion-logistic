<?php
namespace FuxionLogistic\Models;
use FuxionLogistic\Http\Soap\Xml;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use GuzzleHttp\Psr7;
class OperadorLogistico extends Model
{
    protected $table = "operadores_logisticos";
    protected $fillable = [
        'nombre',
        'prefijo',
        'contacto',
        'ws',
        'ubicacion_id',
    ];
    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }
    public function guias()
    {
        return $this->hasMany(Guia::class, 'operador_logistico_id');
    }
    public function guiasAsignadasPorCorte($corte, $count = false)
    {
        $db_row = '(SELECT 
                    pedido_id,t.serie, t.correlativo_2
                FROM
                    (SELECT 
                    v_g.*, GROUP_CONCAT(v_g.correlativo) as correlativo_2
                FROM
                    fuxion_logistic.v_guias_pedidos_corte as v_g
                WHERE
                    v_g.corte_id = '.$corte.'
                GROUP BY v_g.guia_id) AS t
                WHERE t.operador_logistico_id = '.$this->id.'
                GROUP BY t.corte_id , t.operador_logistico_id, t.pedido_id,t.serie, t.correlativo_2) AS t_2';
        //dd(DB::select($db_row));
        if ($count) {
            return $this->guias()->select(
                'guias.*',
                'pedidos.serie',
                'ciudades.nombre as destino',
                'ciudades.nombre as ciudad',
                'departamentos.nombre as departamento',
                'pedidos.correlativo',
                'guias.created_at as fecha_guia',
                'empresarios.tipo as tipo_empresario',
                'users.nombres as empresario',
                //DB::raw('CONCAT(users.nombres," ",users.apellidos) as empresario'),
                'correlativo_2')
                ->join('guias_pedidos', 'guias.id', '=', 'guias_pedidos.guia_id')
                ->join('pedidos', 'guias_pedidos.pedido_id', '=', 'pedidos.id')
                ->join('cortes', 'pedidos.corte_id', '=', 'cortes.id')
                ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
                ->join('ciudades','pedidos.ciudad_id','=','ciudades.id')
                ->join('departamentos','pedidos.departamento_id','=','departamentos.id')
                ->join('users','empresarios.user_id','=','users.id')
                ->join(DB::raw($db_row),'pedidos.id','=','t_2.pedido_id')
                ->where('cortes.id', $corte)
                ->count();
        } else {
            return $this->guias()->select(
                'guias.*',
                'pedidos.serie',
                'ciudades.nombre as destino',
                'ciudades.nombre as ciudad',
                'departamentos.nombre as departamento',
                'pedidos.correlativo',
                'guias.created_at as fecha_guia',
                'empresarios.tipo as tipo_empresario',
                'users.nombres as empresario',
                //DB::raw('CONCAT(users.nombres," ",users.apellidos) as empresario'),
                'correlativo_2')
                ->join('guias_pedidos', 'guias.id', '=', 'guias_pedidos.guia_id')
                ->join('pedidos', 'guias_pedidos.pedido_id', '=', 'pedidos.id')
                ->join('cortes', 'pedidos.corte_id', '=', 'cortes.id')
                ->join('empresarios','pedidos.empresario_id','=','empresarios.id')
                ->join('ciudades','pedidos.ciudad_id','=','ciudades.id')
                ->join('departamentos','pedidos.departamento_id','=','departamentos.id')
                ->join('users','empresarios.user_id','=','users.id')
                ->join(DB::raw($db_row),'pedidos.id','=','t_2.pedido_id')
                ->where('cortes.id', $corte)
                ->get();
        }
    }
    public function excelGuias($corte)
    {
        $guias = $this->guiasAsignadasPorCorte($corte);
        if (strtolower($this->nombre) == 'deprisa') {
            return $this->excelDeprisa($guias);
        } else if (strtolower($this->nombre) == 'servientrega') {
            return $this->excelServientrega($guias);
        }
    }
    public function excelDeprisa($guias)
    {
        $archivo = storage_path('/app/plantillas/operador_logistico/plantilla_deprisa.xlsx');
        $data = [];
        foreach ($guias as $guia) {
            if(!$guia->numero) {
                $empresario = $guia->empresario();
                $user = $empresario->user;
                $factura = $guia->factura();
                $pedido_1 = $guia->pedidos()->first();
                $data[] = [
                    $user->nombres . ' ' . $user->apellidos,
                    $user->identificacion,
                    0,// ?
                    $pedido_1->direccion,
                    $pedido_1->nombreCiudadOL($this->id),
                    $pedido_1->codigoPostal(),
                    $user->telefono,
                    '',// CODIGO DEL PRODUCTO?
                    1,//BULTOS ?
                    1,//KILOS ?
                    '',//MERCANCIA ?
                    '',//VALOR MERCANCIA ?
                    '',//OBSERVACIONES ?
                    $factura
                ];
            }
        }
        return Excel::load($archivo, function ($file) use ($data) {
            $file->sheet('Hoja1', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->download('xls');
    }
    public function excelServientrega($guias)
    {
        $archivo = storage_path('/app/plantillas/operador_logistico/plantilla_servientrega.xlsx');
        $data = [];
        foreach ($guias as $guia) {
            if(!$guia->numero) {
                $empresario = $guia->empresario();
                $user = $empresario->user;
                $factura = $guia->factura();
                $pedido_1 = $guia->pedidos()->first();
                $data[] = [
                    '111111111',
                    $user->nombres . ' ' . $user->apellidos,
                    $pedido_1->direccion,
                    '000000',//$pedido_1->codigoPostal(),
                    $pedido_1->nombreCiudadOL($this->id),
                    //$pedido_1->nombreDepartamentoOL($this->id),
                    $pedido_1->ciudad->departamento->nombre,
                    $user->telefono,
                    $pedido_1->email,
                    $user->telefono,
                    '1',//Tiempo de Entrega; ?
                    '0',//Generar Sobreporte; ?
                    'Generico',//Nombre de la Unidad de Empaque; ?
                    'VITAMINAS',//Dice Contener; ?
                    '300000',//Valor declarado;?
                    '1',//Número de Piezas; ?
                    '1', //Cantidad; ?
                    '1',//Remisión; ?
                    '3',//Alto; ?
                    '3',//Ancho; ?
                    '3',//Largo; ?
                    '3',//Peso; ?
                    '2',//Producto;?
                    '',//Empaque y Embalaje; ?
                    '2',//Forma de Pago; ?
                    '1',//Medio de Transporte; ?
                    '0',//Generar Cajaporte; ?
                    'CM',//Unidad de longitud; ?
                    'KG',//Unidad de peso; ?
                    $factura
                ];
            }
        }
        return Excel::load($archivo, function ($file) use ($data) {
            $file->sheet('Hoja1', function ($sheet) use ($data) {
                $sheet->fromArray($data, null, 'A2', false, false);
            });
        })->download('xls');
    }
    public function enviarGuiasAutomaticas($corte){
        $guias = $this->guias()->select('guias.*','pedidos.serie','pedidos.correlativo')
            ->join('guias_pedidos', 'guias.id', '=', 'guias_pedidos.guia_id')
            ->join('pedidos', 'guias_pedidos.pedido_id', '=', 'pedidos.id')
            ->join('cortes', 'pedidos.corte_id', '=', 'cortes.id')
            ->where('cortes.id', $corte)
            ->where('guias.estado', 'registrada')
			->whereNull('guias.numero')
            ->groupBy('guias.id')
            ->get();
           //dd($guias);
        if(strtolower($this->nombre) == 'deprisa'){
            return $this->enviarGuiasAutomaticasDeprisa($guias);
        }else if(strtolower($this->nombre) == 'servientrega'){
            return $this->enviarGuiasAutomaticasServientrega($guias,$corte);
        }
    }
    public function enviarGuiasAutomaticasDeprisa($guias){

        if(!count($guias))
            return ['guias_enviadas'=>count($guias),'guias_procesadas'=>0,'errores'=>[]];
        set_time_limit(0);
        //$url = 'http://190.86.194.73:38080/conecta2/seam/resource/restv1/';
        $url = 'https://conectados.avianca.com/conecta2/seam/resource/restv1/';
        $headers = [
            'Content-Type'=>'application/xml'
        ];
        $client = new Client(['base_uri'=>$url]);
        $errores = [];
        $guias_procesadas = 0;
        $estado_en_cola = EstadoPedido::where('asignacion_corte','si')->first();
        if(!$estado_en_cola){
            $errores[] = 'No se ha registrado el estado de pedido con corte asignado.';
        }else {
            foreach ($guias as $guia) {
                //echo 'enviando guìa '.$contador.' de '.count($guias).'<br>';
                $body = $this->bodyGuiasAutomaticasDeprisa($guia);
                //dd($body); //Para pruebas de Deprisa
                $response = $client->request('POST', 'admision_envios', [
                    'headers' => $headers,
                    'body' => $body
                ]);
                $stream_body = Psr7\stream_for($response->getBody());
                $xml_body = simplexml_load_string($stream_body);
				//dd($body);
                if ($response->getStatusCode() == '200') {
                    if ($xml_body->ERRORES && $xml_body->ERRORES->ERROR) {
                        foreach ($xml_body->ERRORES->ERROR as $error) {
                            $errores[] = $error['ERROR_DESCRIPCION'] . ' (' . $guia->serie . '-' . $guia->correlativo . ')';
                        }
                    } else if ($xml_body->ADMISIONES && $xml_body->ADMISIONES->RESPUESTA_ADMISION) {
                        $guia->numero = $xml_body->ADMISIONES->RESPUESTA_ADMISION->NUMERO_ENVIO;
                        $guia->estado = 'enviada';
                        $guia->save();
                        $pedidos = $guia->pedidos;
                        foreach ($pedidos as $pedido) {
                            $pedido->estadosPedidos()->save($estado_en_cola);
                        }
                        $guias_procesadas++;
                    }
                } else {
                    $errores[] = 'Ocurrio un error el registrar la guìa de la factura ' . $guia->serie . '-' . $guia->correlativo;
                }
            }
        }
        return ['guias_enviadas'=>count($guias),'guias_procesadas'=>$guias_procesadas,'errores'=>$errores];
    }
    public function bodyGuiasAutomaticasDeprisa($guia){
        //$array_data = ['ADMISIONES'];
        $xml = new \SimpleXMLElement('<ADMISIONES/>');
        $pedido = $guia->pedidos()->first();
        $empresario = $pedido->empresario;
        $user = $empresario->user;
        $data['ADMISION'] = [
            'GRABAR_ENVIO'=>'S',
            'CODIGO_ADMISION'=>$pedido->correlativo,
            'NUMERO_ENVIO'=>'',
            'NUMERO_BULTOS'=>'1',
            'FECHA_HORA_ADMISION'=>date('Y-m-d H:i:s'),
            'CLIENTE_REMITENTE'=>'00008616',
            'CENTRO_REMITENTE'=>'02',
            'NOMBRE_REMITENTE'=>'',
            'DIRECCION_REMITENTE'=>'',
            'PAIS_REMITENTE'=>'057',
            'CODIGO_POSTAL_REMITENTE'=>'',
            'POBLACION_REMITENTE'=>'',
            'TIPO_DOC_REMITENTE'=>'',
            'DOCUMENTO_IDENTIDAD_REMITENTE'=>'',
            'PERSONA_CONTACTO_REMITENTE'=>'',
            'TELEFONO_CONTACTO_REMITENTE'=>'',
            'DEPARTAMENTO_REMITENTE'=>'',
            'EMAIL_REMITENTE'=>'',
            'CLIENTE_DESTINATARIO'=>'99999999',
            'CENTRO_DESTINATARIO'=>'99',
            'NOMBRE_DESTINATARIO'=>$pedido->serie.'-'.$pedido->correlativo.'/'.$pedido->first_name.' '.$pedido->last_name,
            'DIRECCION_DESTINATARIO'=>$pedido->direccion,
            'PAIS_DESTINATARIO'=>'057',
            'CODIGO_POSTAL_DESTINATARIO'=>$pedido->codigoPostal(),
            'POBLACION_DESTINATARIO'=>$pedido->nombreCiudadOL($this->id),
            'TIPO_DOC_DESTINATARIO'=>$user->tipo_identificacion?str_replace('.','',$user->tipo_identificacion):'CC',
            'DOCUMENTO_IDENTIDAD_DESTINATARIO'=>$user->identificacion?$user->identificacion:'111111111',
            'PERSONA_CONTACTO_DESTINATARIO'=>$pedido->first_name.' '.$pedido->last_name,
            'TELEFONO_CONTACTO_DESTINATARIO'=>$user->telefono,
            'DEPARTAMENTO_DESTINATARIO'=>$pedido->nombreDepartamentoOL($this->id),
            'EMAIL_DESTINATARIO'=>$pedido->email,
            'INCOTERM'=>'',
            'RAZON_EXPORTAR'=>'',
            'EMBALAJE'=>'',
            'CODIGO_SERVICIO'=>'3005',
            'KILOS'=>'3',
            'VOLUMEN'=>'0.003',
            'LARGO'=>'0.1',
            'ANCHO'=>'0.2',
            'ALTO'=>'0.15',
            'NUMERO_REFERENCIA'=>$pedido->serie.'-'.$pedido->correlativo,
            'IMPORTE_REEMBOLSO'=>'',
            'IMPORTE_VALOR_DECLARADO'=>'100000',
            'TIPO_PORTES'=>'P',
            'OBSERVACIONES1'=>$pedido->serie.'-'.$pedido->correlativo,
            'OBSERVACIONES2'=>'',
            'TIPO_MERCANCIA'=>'',
            'ASEGURAR_ENVIO'=>'S',
            'TIPO_MONEDA'=>'COP',
        ];
        Xml::array_to_xml($data,$xml);
        $return = str_replace('<?xml version="1.0"?>','',$xml->asXML());
        return $return;
        return $return;
    }
    public function enviarGuiasAutomaticasServientrega($guias,$id_corte){
        //return ['guias_enviadas'=>count($guias),'guias_procesadas'=>0,'errores'=>['Primer error','Segundo error']];
        //dd($guias);
        if(!count($guias))
            return ['guias_enviadas'=>count($guias),'guias_procesadas'=>0,'errores'=>[]];
        $errores = [];
        $estado_en_cola = EstadoPedido::where('asignacion_corte','si')->first();
        if(!$estado_en_cola){
            $errores[] = 'No se ha registrado el estado de pedido con corte asignado.';
        }else {
            set_time_limit(0);
            /*$params_body = [
                'CargueMasivoExterno'=>[
                    'envios'=>[
                        'CargueMasivoExternoDTO'=>[
                            'objEnvios'=>[
                                'EnviosExterno'=>[
                                    [
                                        'Num_Guia'=>'0',
                                        'Num_Sobreporte'=>'0',
                                        'Doc_Relacionado'=>"", //Se cambiaron los null por "" para que llegue el parámetro al server
                                        'Num_Piezas'=>1,//Se quitaron las comillas en algunos parámetros integer, aunque puede darse que algunos los acepte. Eso no se probó
                                        'Des_TipoTrayecto'=>1,
                                        'Ide_Producto'=>2,
                                        'Des_FormaPago'=>2,
                                        'Des_MedioTransporte'=>1,
                                        'Num_PesoTotal'=>'3',
                                        'Num_ValorDeclaradoTotal'=>'5500',
                                        'Num_VolumenTotal'=>'0',
                                        'Num_BolsaSeguridad'=>'0',
                                        'Num_Precinto'=>'0',
                                        'Des_TipoDuracionTrayecto'=>1,
                                        'Des_Telefono'=>'3209179277',
                                        'Des_Ciudad'=>'Popayan',
                                        'Des_Direccion'=>'Carrera 33 #4-84',
                                        'Nom_Contacto'=>'Jose Luis',
                                        'Des_VlrCampoPersonalizado1'=>"",
                                        'Num_ValorLiquidado'=>'0',
                                        'Des_DiceContener'=>'Indumentaria',
                                        'Des_TipoGuia'=>1,
                                        'Num_VlrSobreflete'=>'0',
                                        'Num_VlrFlete'=>'0',
                                        'Num_Descuento'=>'0',
                                        'idePaisOrigen'=>1,
                                        'idePaisDestino'=>1,
                                        'Des_IdArchivoOrigen'=>"",
                                        'Des_DireccionRemitente'=>"",
                                        'Num_PesoFacturado'=>0,
                                        'Est_CanalMayorista'=>false,
                                        'Num_IdentiRemitente'=>"",
                                        'Num_TelefonoRemitente'=>"",
                                        'Num_Alto'=>1,
                                        'Num_Ancho'=>1,
                                        'Num_Largo'=>1,
                                        'Des_DepartamentoDestino'=>'Cauca',
                                        'Des_DepartamentoOrigen'=>'Cundinamarca',
                                        'Gen_Cajaporte'=>false,
                                        'Gen_Sobreporte'=>false,
                                        'Nom_UnidadEmpaque'=>'GENERICA',
                                        'Nom_RemitenteCanal'=>"",
                                        'Des_UnidadLongitud'=>'cm',
                                        'Des_UnidadPeso'=>'kg',
                                        'Num_ValorDeclaradoSobreTotal'=>'0',
                                        'Num_Factura'=>'FAC-001',
                                        'Des_CorreoElectronico'=>'jlcapote@misena.ecu.co',
                                        'Ide_Destinatarios'=>'00000000-0000-0000-0000-000000000000',
                                        'Ide_Manifiesto'=>'00000000-0000-0000-0000-000000000000',
                                        'Est_EnviarCorreo'=>false,
                                    ],
                                    [
                                        'Num_Guia'=>'0',
                                        'Num_Sobreporte'=>'0',
                                        'Doc_Relacionado'=>"", //Se cambiaron los null por "" para que llegue el parámetro al server
                                        'Num_Piezas'=>1,//Se quitaron las comillas en algunos parámetros integer, aunque puede darse que algunos los acepte. Eso no se probó
                                        'Des_TipoTrayecto'=>1,
                                        'Ide_Producto'=>2,
                                        'Des_FormaPago'=>2,
                                        'Des_MedioTransporte'=>1,
                                        'Num_PesoTotal'=>'3',
                                        'Num_ValorDeclaradoTotal'=>'5500',
                                        'Num_VolumenTotal'=>'0',
                                        'Num_BolsaSeguridad'=>'0',
                                        'Num_Precinto'=>'0',
                                        'Des_TipoDuracionTrayecto'=>1,
                                        'Des_Telefono'=>'3209179277',
                                        'Des_Ciudad'=>'Popayan',
                                        'Des_Direccion'=>'Carrera 33 #4-84',
                                        'Nom_Contacto'=>'Jose Luis',
                                        'Des_VlrCampoPersonalizado1'=>"",
                                        'Num_ValorLiquidado'=>'0',
                                        'Des_DiceContener'=>'Indumentaria',
                                        'Des_TipoGuia'=>1,
                                        'Num_VlrSobreflete'=>'0',
                                        'Num_VlrFlete'=>'0',
                                        'Num_Descuento'=>'0',
                                        'idePaisOrigen'=>1,
                                        'idePaisDestino'=>1,
                                        'Des_IdArchivoOrigen'=>"",
                                        'Des_DireccionRemitente'=>"",
                                        'Num_PesoFacturado'=>0,
                                        'Est_CanalMayorista'=>false,
                                        'Num_IdentiRemitente'=>"",
                                        'Num_TelefonoRemitente'=>"",
                                        'Num_Alto'=>1,
                                        'Num_Ancho'=>1,
                                        'Num_Largo'=>1,
                                        'Des_DepartamentoDestino'=>'Cauca',
                                        'Des_DepartamentoOrigen'=>'Cundinamarca',
                                        'Gen_Cajaporte'=>false,
                                        'Gen_Sobreporte'=>false,
                                        'Nom_UnidadEmpaque'=>'GENERICA',
                                        'Nom_RemitenteCanal'=>"",
                                        'Des_UnidadLongitud'=>'cm',
                                        'Des_UnidadPeso'=>'kg',
                                        'Num_ValorDeclaradoSobreTotal'=>'0',
                                        'Num_Factura'=>'FAC-001',
                                        'Des_CorreoElectronico'=>'jlcapote@misena.ecu.co',
                                        'Ide_Destinatarios'=>'00000000-0000-0000-0000-000000000000',
                                        'Ide_Manifiesto'=>'00000000-0000-0000-0000-000000000000',
                                        'Est_EnviarCorreo'=>false,
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];*/
            $params_body = $this->bodyGuiasAutomaticasServientrega($guias);
            //dd($params_body);  //para pruebas de servientrega

            /*  //XML QUE SE VA A ENVIAR
            $xml = new \SimpleXMLElement('<CargueMasivoExterno/>');
            Xml::array_to_xml($params_body,$xml);
            dd($xml->asXml());*/

            $servicio = 'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl';
            $params = [
                'location' => 'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl',
                'uri' => 'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl',
                'soap_version' => SOAP_1_1, //Version de soap que funcionó
                "exceptions" => 0, //Manejo de todas las excepciones
                'trace' => 1 //Se le da trazabilidad para debugguear
            ];


            $client = new \SoapClient($servicio, $params);
            $auth = array(
               /* 'login' => 'Luis1937',
                'pwd' => 'MZR0zNqnI/KplFlYXiFk7m8/G/Iqxb3O',
                'Id_CodFacturacion' => '98358',
                'Nombre_Cargue' => 'INTEGRACION INFO_CLIENTE',
                */
                'login' => '900413155suc3',
                'pwd' => 'UagHfHOG9bPZ0t2FDmzwjiOGX67fSRaP',
                'Id_CodFacturacion' => 'SER98358',
                'Nombre_Cargue' => 'FUXION',
            );
            //El namespace es estrictamente http://tempuri.org/
            $header = new \SoapHeader('http://tempuri.org/', 'AuthHeader', $auth, false);
            $client->__setSoapHeaders($header);
            $response = $client->__soapCall('CargueMasivoExterno', $params_body);

             // dd($response);
             // dd($client);
            $guias_procesadas = 0;
            if ($response->CargueMasivoExternoResult) {
                $data_envios = $response->envios->CargueMasivoExternoDTO->objEnvios->EnviosExterno;
                //DB::beginTransaction();
                if (is_array($data_envios)) {
                    foreach ($data_envios as $data_envio) {
                        //echo $data_envio->Num_Guia . '*****';
                        $data_factura = explode('-', $data_envio->Num_Factura);
                        //echo $data_envio->Num_Factura.'<br>';
                        $guia = $this->guias()->select('guias.*')
                            ->join('guias_pedidos', 'guias.id', '=', 'guias_pedidos.guia_id')
                            ->join('pedidos', 'guias_pedidos.pedido_id', '=', 'pedidos.id')
                            ->join('cortes', 'pedidos.corte_id', '=', 'cortes.id')
                            ->where('cortes.id', $id_corte)
                            ->where('guias.estado', 'registrada')
                            ->whereNull('guias.numero')
                            ->where('pedidos.serie', $data_factura[0])
                            ->where('pedidos.correlativo', explode(' ',$data_factura[1])[0])
                            ->where('guias.estado', 'registrada')->first();
                        if (!$guia) {
                            $errores[] = 'Ocurrio un error al registrar la guìa de la factura ' . $data_factura[0] . '-' . explode(' ',$data_factura[1])[0];
                        } else {
                            $guia->numero = $data_envio->Num_Guia;
                            $guia->estado = 'enviada';
                            $guia->save();
                            $pedidos = $guia->pedidos;
                            foreach ($pedidos as $pedido) {
                                $pedido->estadosPedidos()->save($estado_en_cola);
                            }
                            $guias_procesadas++;
                        }
                    }
                } else {
                    //echo $data_envios->Num_Guia . '*****';
                    $data_factura = explode('-', $data_envios->Num_Factura);
                    //echo $data_envios->Num_Factura.'<br>';
                    $guia = $this->guias()->select('guias.*')
                        ->join('guias_pedidos', 'guias.id', '=', 'guias_pedidos.guia_id')
                        ->join('pedidos', 'guias_pedidos.pedido_id', '=', 'pedidos.id')
                        ->join('cortes', 'pedidos.corte_id', '=', 'cortes.id')
                        ->where('cortes.id', $id_corte)
                        ->where('guias.estado', 'registrada')
                        ->whereNull('guias.numero')
                        ->where('pedidos.serie', $data_factura[0])
                        ->where('pedidos.correlativo', explode(' ',$data_factura[1])[0])
                        ->where('guias.operador_logistico_id', $this->id)
                        ->where('guias.estado', 'registrada')->first();
                    if (!$guia) {
                        $errores[] = 'Ocurrio un error el registrar la guìa de la factura ' . $data_factura[0] . '-' . explode(' ',$data_factura[1])[0];
                    } else {
                        $guia->numero = $data_envios->Num_Guia;
                        $guia->estado = 'enviada';
                        $guia->save();
                        $pedidos = $guia->pedidos;
                        foreach ($pedidos as $pedido) {
                            $pedido->estadosPedidos()->save($estado_en_cola);
                        }
                        $guias_procesadas++;
                    }
                }
                //DB::commit();
            } else {
                $errores = (array)json_encode($response->arrayGuias,true);
				//dd($errores);
                foreach ($errores as $e) {
                    for ($i = 0; $i < count($e); $i++) {
                        $errores[] = $e[$i];
                    }
                }
            }
        }
        return ['guias_enviadas'=>count($guias),'guias_procesadas'=>$guias_procesadas,'errores'=>$errores];
    }
    public function bodyGuiasAutomaticasServientrega($guias){
        $envios = [];
        foreach ($guias as $guia){
            $pedido = $guia->pedidos()->first();
            $factura = $guia->factura();
            $empresario = $pedido->empresario;
            $user = $empresario->user;
            $envios[] = [
                'Num_Guia'=>'0',
                'Num_Sobreporte'=>'0',
                'Doc_Relacionado'=>"", //Se cambiaron los null por "" para que llegue el parámetro al server
                'Num_Piezas'=>1,//Se quitaron las comillas en algunos parámetros integer, aunque puede darse que algunos los acepte. Eso no se probó
                'Des_TipoTrayecto'=>1,
                'Ide_Producto'=>2,
                'Des_FormaPago'=>2,
                'Des_MedioTransporte'=>1,
                'Num_PesoTotal'=>'3',
                'Num_ValorDeclaradoTotal'=>'100000',
                'Num_VolumenTotal'=>'0.003',
                'Num_BolsaSeguridad'=>'0',
                'Num_Precinto'=>'0',
                'Des_TipoDuracionTrayecto'=>1,
                'Des_Telefono'=>$user->telefono?$user->telefono:'0000000000',
                'Des_Ciudad'=>$pedido->nombreCiudadOL($this->id),
                'Des_Direccion'=>$pedido->direccion,
                'Nom_Contacto'=>$factura.'/'.$pedido->first_name.' '.$pedido->last_name,
                'Des_VlrCampoPersonalizado1'=>"",
                'Num_ValorLiquidado'=>'0',
                'Des_DiceContener'=>'Indumentaria',
                'Des_TipoGuia'=>1,
                'Num_VlrSobreflete'=>'0',
                'Num_VlrFlete'=>'0',
                'Num_Descuento'=>'0',
                'idePaisOrigen'=>1,
                'idePaisDestino'=>1,
                'Des_IdArchivoOrigen'=>"",
                'Des_DireccionRemitente'=>"",
                'Num_PesoFacturado'=>0,
                'Est_CanalMayorista'=>false,
                'Num_IdentiRemitente'=>"",
                'Num_TelefonoRemitente'=>"",
                'Num_Alto'=>15,
                'Num_Ancho'=>20,
                'Num_Largo'=>10,
                //'Des_DepartamentoDestino'=>$pedido->nombreDepartamentoOL($this->id),
                'Des_DepartamentoDestino'=>$pedido->ciudad->departamento->nombre,
                'Des_DepartamentoOrigen'=>'Cundinamarca',
                'Gen_Cajaporte'=>false,
                'Gen_Sobreporte'=>false,
                'Nom_UnidadEmpaque'=>'GENERICO',
                'Nom_RemitenteCanal'=>"",
                'Des_UnidadLongitud'=>'cm',
                'Des_UnidadPeso'=>'kg',
                'Num_ValorDeclaradoSobreTotal'=>'0',
                'Num_Factura'=>$factura,
                'Des_CorreoElectronico'=>$pedido->email,
                'Ide_Destinatarios'=>'00000000-0000-0000-0000-000000000000',
                'Ide_Manifiesto'=>'00000000-0000-0000-0000-000000000000',
                'Est_EnviarCorreo'=>false,
            ];
            //echo $pedido->serie.'-'.$pedido->correlativo.' SET <br>';
        }
        $params_body = [
            'CargueMasivoExterno'=>[
                'envios'=>[
                    'CargueMasivoExternoDTO'=>[
                        'objEnvios'=>[
                            'EnviosExterno'=>$envios
                        ]
                    ]
                ]
            ]
        ];
        return $params_body;
    }
}