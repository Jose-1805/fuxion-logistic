<?php

namespace FuxionLogistic\Http\Controllers;

use FuxionLogistic\Http\Soap\CargueMasivoServientrega;
use FuxionLogistic\Http\Soap\PruebaMultiplicacion;
use FuxionLogistic\Http\Soap\Xml;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\SoapWrapper;
class SoapController extends Controller
{
    /**
     * @var SoapWrapper
     */
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param SoapWrapper $soapWrapper
     */
    public function __construct(SoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    /**
     * Use the SoapWrapper
     */
    public function show()
    {
/*
 *
 * Se agregaron comentarios para guiar el desarrollo
 *
 * */

        $params_body = [
            'CargueMasivoExterno'=>[
                'envios'=>[
                    'CargueMasivoExternoDTO'=>[
                        'objEnvios'=>[
                            'EnviosExterno'=>[
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
        ];

        $servicio = 'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl';
        $params = [
            'location'=>'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl',
            'uri'=>'http://web.servientrega.com:8081/GeneracionGuias.asmx?wsdl',
            'soap_version' => SOAP_1_1, //Version de soap que funcionó
            "exceptions" => 0, //Manejo de todas las excepciones
            'trace'=>1 //Se le da trazabilidad para debugguear
        ];

        $client = new \SoapClient($servicio,$params);

        $auth = array(
            'login'=>'Luis1937',
            'pwd'=>'MZR0zNqnI/KplFlYXiFk7m8/G/Iqxb3O',
            'Id_CodFacturacion'=> 'SER408',
            'Nombre_Cargue'=> 'INTEGRACION INFO_CLIENTE',
        );
//El namespace es estrictamente http://tempuri.org/

        $header = new \SoapHeader('http://tempuri.org/','AuthHeader',$auth,false);
        $client->__setSoapHeaders($header);

         $response = $client->__soapCall('CargueMasivoExterno',$params_body);

// A continuación se imprimen la solicitud y la respuesta

        echo "<br>====== REQUEST HEADERS =====<br>";
        echo "<pre>".htmlspecialchars($client->__getLastRequestHeaders(), ENT_QUOTES)."</pre>";
        echo "<br>========= REQUEST ==========<br>";
        echo "<pre>".htmlspecialchars($client->__getLastRequest(), ENT_QUOTES)."</pre>";


        dd($response);
    }
}