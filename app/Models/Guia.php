<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Psr7;

class Guia extends Model
{
    protected $table = 'guias';
    protected $fillable = [
        'numero',
        'estado',
        'operador_logistico_id',
        'malla_cobertura_id',
        'foto_1',
        'foto_2',
    ];

    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'guias_pedidos', 'guia_id', 'pedido_id');
    }

    public function operadorLogistico()
    {
        return $this->belongsTo(OperadorLogistico::class, 'operador_logistico_id');
    }

    public function empresario()
    {
        return Empresario::select('empresarios.*')
            ->join('pedidos', 'empresarios.id', '=', 'pedidos.empresario_id')
            ->join('guias_pedidos', 'pedidos.id', '=', 'guias_pedidos.pedido_id')
            ->join('guias', 'guias_pedidos.guia_id', '=', 'guias.id')
            ->where('guias.id', $this->id)->first();
    }

    public function factura()
    {
        $pedidos = $this->pedidos;
        $facttura = '';
        $aux = 0;
        foreach ($pedidos as $pedido) {
            $aux++;
            if ($aux == 1) {
                $facttura .= $pedido->serie . '-' . $pedido->correlativo;
            } else {
                $facttura .= '/' . $pedido->correlativo;
            }
        }
        return $facttura;
    }

    public static function tracking()
    {
        $guias_deprisa = Guia::select('guias.*')->join('operadores_logisticos','guias.operador_logistico_id','=','operadores_logisticos.id')
            ->where('guias.estado','enviada')->where('operadores_logisticos.nombre','deprisa')->get();

        $guias_servientrega = Guia::select('guias.*')->join('operadores_logisticos','guias.operador_logistico_id','=','operadores_logisticos.id')
            ->where('guias.estado','enviada')->where('operadores_logisticos.nombre','servientrega')->get();

		//dd($guias_servientrega);
        if(count($guias_deprisa))
            self::trackingDeprisa($guias_deprisa);
        if(count($guias_servientrega))
            self::trackingServientrega($guias_servientrega);

    }

    public static function trackingDeprisa($guias)
    {
        set_time_limit(0);
        $errores = [];
        $error = true;

        $url = 'https://conectados.avianca.com/conecta2/seam/resource/restv1/tracking/';

        $headers = [
            'Content-Type' => 'application/xml'
        ];

        $client = new Client(
            [
                'base_uri' => $url,
                'http_errors' => false,
            ]);

        foreach ($guias as $guia) {
            $response = $client->request('GET', $guia->numero, [
                'headers' => $headers,
            ]);

            $stream_body = Psr7\stream_for($response->getBody());

            if ($response->getStatusCode() == '404') {
                $errores[] = 'No se encontro ninguna guía con el número ' . $guia->numero . '.';
            } else if ($response->getStatusCode() == '400') {
                $errores[] = 'El número de guía ' . $guia->numero . ' es incorrecto (mínimo 6 caracteres).';
            } else if ($response->getStatusCode() == '500') {
                $errores[] = 'Ocurrio un error interno del servidor de consulta al procesaro la guía No. '.$guia->numero.'.';
            } else if ($response->getStatusCode() == '200'){
                $xml_body = simplexml_load_string($stream_body);
                //dd($xml_body->NOMBRE_QUIEN_RECIBE);
				//dd($xml_body->ESTADOS);
                if ($xml_body->ESTADOS && $xml_body->ESTADOS->ESTADO){
                    $estados = $xml_body->ESTADOS[0];
                    for ($i = count($estados)-1;$i >= 0;$i--){
                        $estado = $estados->ESTADO[$i];
                        $estado_guia = new EstadoGuiaOperadorLogistico();
                        $estado_guia->estado = $estado->TIPO_EVENTO_CODIGO?$estado->TIPO_EVENTO_CODIGO:null;
                        $estado_guia->descripcion = $estado->DESCRIPCION?$estado->DESCRIPCION:null;
                        $estado_guia->id_estado = $estado->CODIGO_SEGUIMIENTO?$estado->CODIGO_SEGUIMIENTO:null;
						$estado_guia->quien_recibe = $xml_body->NOMBRE_QUIEN_RECIBE?$xml_body->NOMBRE_QUIEN_RECIBE:null;
                        $estado_guia->fecha = null;
                        if($estado->FECHA_EVENTO) {
                            $fecha = \DateTime::createFromFormat('d/m/Y H:i', $estado->FECHA_EVENTO);
                            $fecha = $fecha->format('Y-m-d H:i:s');
                            $estado_guia->fecha = $fecha;
                        }

                       /* $estado_guia->novedad = null;
                        if($estado->TIPO_EVENTO_CODIGO=='INCI') {
                            $incidencias = $xml_body->INCIDENCIAS;
                            if($incidencias && $incidencias->INCIDENCIA) {
                                $codigo = explode('Tipo',$estado->DESCRIPCION);
                                $codigo = $codigo[(count($codigo)-1)];
                                $codigo = trim($codigo);
                                foreach ($incidencias->INCIDENCIA as $incidencia) {
                                    if($incidencia->ID == $codigo){
                                        $estado_guia->novedad = $incidencia->DESCRIPCION;
                                        $estado_guia->estado = 'novedad';
                                        break;
                                    }
                                }
                            }
                        }
                        */
                        $estado_guia->guia_id = $guia->id;

                        //se busca un estado con los mismos datos para la misma guía
                        $estado_guia_duplicado = EstadoGuiaOperadorLogistico::
                                    where('estado',$estado_guia->estado)
                                    ->where('descripcion',$estado_guia->descripcion)
                                    ->where('id_estado',$estado_guia->id_estado)
                                    ->where('fecha',$estado_guia->fecha)
                                    ->where('novedad',$estado_guia->novedad)
                                    ->where('guia_id',$estado_guia->guia_id)->first();

                        if(!$estado_guia_duplicado){
                            $estado_guia->save();
                            $nombre_estado_ol = NombreEstadoOperadorLogistico::where('nombre',$estado_guia->estado)
                                ->where('operador_logistico_id',$guia->operador_logistico_id)->first();

                            if($nombre_estado_ol){
                                $estado_guia->nombre_estado_operador_logistico_id = $nombre_estado_ol->id;
                                $estado_guia->save();
                                $estado_ol = $nombre_estado_ol->estadoOperadorLogistico;

                                $pedidos = $guia->pedidos;
                                if($estado_ol->cambio_estado_pedido_id){
                                    $estado_cambio = EstadoPedido::find($estado_ol->cambio_estado_pedido_id);
                                    foreach ($pedidos as $p){
                                        if($estado_cambio->notificacion_correo == 'si'){
                                            Correo::cambioEstadoEnSistema($p,$estado_cambio);
                                        }else if ($estado_ol->notificacion_correo == 'si') {
                                            Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                        }

                                        if($estado_cambio->notificacion_push == 'si'){
                                            NotificacionPush::cambioEstado($p,$estado_cambio,$estado_cambio->nombre);
                                        }else if($estado_ol->notificacion_push == 'si'){
                                            NotificacionPush::cambioEstado($p,$estado_ol,$estado_ol->nombre);
                                        }
                                        $p->estadosPedidos()->save($estado_cambio);
                                        if($estado_guia->estado == 'novedad'){
                                            $p->novedad = $estado_guia->novedad;
                                            $p->save();
                                        }
                                    }
                                    if($estado_cambio->pedido_entregado == 'si'){
                                        $guia->estado = 'entregada';
                                        $guia->save();
                                    }
                                }else{
                                    foreach ($pedidos as $p) {
                                        if ($estado_ol->notificacion_correo == 'si') {
                                            Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                        }

                                        if($estado_ol->notificacion_push == 'si'){
                                            NotificacionPush::cambioEstado($p,$estado_ol,$estado_ol->nombre);
                                        }
                                    }
                                }
                            }
                        }

                    }
                }

                    

					if ($xml_body->INCIDENCIAS && $xml_body->INCIDENCIAS->INCIDENCIA) {


                    $incidencias = $xml_body->INCIDENCIAS;
                    if ($incidencias && $incidencias->INCIDENCIA) {

                        foreach ($incidencias->INCIDENCIA as $incidencia) {
                            $estado_guia = new EstadoGuiaOperadorLogistico();
                            $estado_guia->id_estado = null;
                            $estado_guia->descripcion = (string)$incidencia->DESCRIPCION;
                            $estado_guia->guia_id = $guia->id;
                            $estado_guia->novedad = (string)$incidencia->DESCRIPCION;
                            $estado_guia->estado = 'novedad';
                            $fecha = \DateTime::createFromFormat('d/m/Y H:i', $incidencia->FECHA_ALTA);
                            $fecha = $fecha->format('Y-m-d H:i:s');
                            $estado_guia->fecha = $fecha;

                            $estado_guia_duplicado = EstadoGuiaOperadorLogistico::
                            where('estado', $estado_guia->estado)
                                ->where('descripcion', $estado_guia->descripcion)
                                ->where('id_estado', $estado_guia->id_estado)
                                ->where('fecha', $estado_guia->fecha)
                                ->where('guia_id', $estado_guia->guia_id)->first();

                            if (!$estado_guia_duplicado) {
                                //dd($estado_guia_duplicado);
                                $estado_guia->save();
                                $nombre_estado_ol = NombreEstadoOperadorLogistico::where('nombre', $estado_guia->estado)
                                    ->where('operador_logistico_id', $guia->operador_logistico_id)->first();
                                //dd($nombre_estado_ol);
                                if ($nombre_estado_ol) {
                                    $estado_guia->nombre_estado_operador_logistico_id = $nombre_estado_ol->id;
                                    $estado_guia->save();
                                    $estado_ol = $nombre_estado_ol->estadoOperadorLogistico;

                                    $pedidos = $guia->pedidos;
                                    if ($estado_ol->cambio_estado_pedido_id) {
                                        $estado_cambio = EstadoPedido::find($estado_ol->cambio_estado_pedido_id);
                                        foreach ($pedidos as $p) {
                                            if ($estado_cambio->notificacion_correo == 'si') {
                                                Correo::cambioEstadoEnSistema($p, $estado_cambio);
                                                //echo "<br>Enviando correo Cambio de Estado en Sistema";
                                            } else if ($estado_ol->notificacion_correo == 'si') {
                                                Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                                //echo "<br>Enviando correo Cambio de Estado en Operador Logistico";
                                            }
                                            if ($estado_cambio->notificacion_push == 'si') {
                                                NotificacionPush::cambioEstado($p, $estado_cambio, $estado_cambio->nombre);
                                                //echo "<br>Enviando Notificacion Push en Cambio de Estado";
                                            } else if ($estado_ol->notificacion_push == 'si') {
                                                NotificacionPush::cambioEstado($p, $estado_ol, $estado_ol->nombre);
                                                // echo "<br>Enviando Notificacion Push en Cambio de Estado OL";
                                            }
                                            $p->estadosPedidos()->save($estado_cambio);
                                            if ($estado_guia->estado == 'novedad') {
                                                $p->novedad = $estado_guia->novedad;
                                                $p->save();
                                            }
                                            
                                        }

                                    }
                                }
                            }
                        }

                    }


                }
					

                   

            }
        }

        return ['error' => $error, 'errores' => $errores];
    }

    public static function trackingServientrega_($guias)
    {
        set_time_limit(0);
        $errores = [];
        $error = false;

        $servicio = 'http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?wsdl';
        $params = [
            'location' => 'http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?wsdl',
            'uri' => 'http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?wsdl',
            'soap_version' => SOAP_1_1, //Version de soap que funcionó
            "exceptions" => 0, //Manejo de todas las excepciones
            'trace' => 1 //Se le da trazabilidad para debugguear
        ];

        $client = new \SoapClient($servicio, $params);

        //El namespace es estrictamente http://servientrega.com/
        $header = new \SoapHeader('http://servientrega.com/', 'Header');
        $client->__setSoapHeaders($header);
        foreach ($guias as $guia) {
            $params_body = ['EstadoGuia' => [
                'ID_Cliente' => '900413155',
                'guia' => $guia->numero
            ]];

            $response = $client->__soapCall('EstadoGuia', $params_body);

            //dd($response);
            if($response->EstadoGuiaResult){
                $xml_body = simplexml_load_string($response->EstadoGuiaResult->any);

                $estado = $xml_body->NewDataSet->EstadosGuias;

                $estado_guia = new EstadoGuiaOperadorLogistico();
                $estado_guia->estado = $estado->Estado_Envio?$estado->Estado_Envio:null;
                $estado_guia->descripcion = $estado->Estado_Envio?$estado->Estado_Envio:null;
                $estado_guia->id_estado = $estado->IdEstadoEnvio?$estado->IdEstadoEnvio:null;
                $estado_guia->fecha = null;
                if($estado->Fecha_Entrega) {
                    $fecha = strtotime($estado->Fecha_Entrega);
                    $fecha = date('Y-m-d H:i:s',$fecha);
                    $estado_guia->fecha = $fecha;
                }

                if($estado->Novedad) {
                    $estado_guia->estado = 'novedad';
                    $estado_guia->novedad = $estado->Novedad;
                }
                $estado_guia->guia_id = $guia->id;

                //se busca un estado con los mismos datos para la misma guía
                $estado_guia_duplicado = EstadoGuiaOperadorLogistico::
                    where('estado',$estado_guia->estado)
                    ->where('descripcion',$estado_guia->descripcion)
                    ->where('id_estado',$estado_guia->id_estado)
                    ->where('fecha',$estado_guia->fecha)
                    ->where('novedad',$estado_guia->novedad)
                    ->where('guia_id',$estado_guia->guia_id)->first();

                if(!$estado_guia_duplicado){
                    $estado_guia->save();
                    $nombre_estado_ol = NombreEstadoOperadorLogistico::where('nombre',$estado_guia->estado)
                        ->where('operador_logistico_id',$guia->operador_logistico_id)->first();
                    if($nombre_estado_ol){
                        $estado_guia->nombre_estado_operador_logistico_id = $nombre_estado_ol->id;
                        $estado_guia->save();
                        $estado_ol = $nombre_estado_ol->estadoOperadorLogistico;

                        $pedidos = $guia->pedidos;
                        if($estado_ol->cambio_estado_pedido_id){
                            $estado_cambio = EstadoPedido::find($estado_ol->cambio_estado_pedido_id);
                            foreach ($pedidos as $p){
                                if($estado_cambio->notificacion_correo == 'si'){
                                    Correo::cambioEstadoEnSistema($p,$estado_cambio);
                                }else if ($estado_ol->notificacion_correo == 'si') {
                                    Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                }
                                if($estado_cambio->notificacion_push == 'si'){
                                    NotificacionPush::cambioEstado($p,$estado_cambio,$estado_cambio->nombre);
                                }else if($estado_ol->notificacion_push == 'si'){
                                    NotificacionPush::cambioEstado($p,$estado_ol,$estado_ol->nombre);
                                }
                                $p->estadosPedidos()->save($estado_cambio);
                                if($estado_guia->estado == 'novedad'){
                                    $p->novedad = $estado_guia->novedad;
                                    $p->save();
                                }
                            }
                            if($estado_cambio->pedido_entregado == 'si'){
                                $guia->estado = 'entregada';
                                $guia->save();
                            }
                        }else{
                            foreach ($pedidos as $p){
                                if ($estado_ol->notificacion_correo == 'si') {
                                    Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                }

                                if($estado_ol->notificacion_push == 'si'){
                                    NotificacionPush::cambioEstado($p,$estado_ol,$estado_ol->nombre);
                                }
                            }
                        }

                    }
                }
            }
        }

        return ['error' => $error, 'errores' => $errores];
    }

    public static function trackingServientrega($guias)
    {
        set_time_limit(0);
        $errores = [];
        $error = false;

        $servicio = 'http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?wsdl';
        $params = [
            'location' => 'http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?wsdl',
            'uri' => 'http://sismilenio.servientrega.com.co/wsrastreoenvios/wsrastreoenvios.asmx?wsdl',
            'soap_version' => SOAP_1_1, //Version de soap que funcionó
            "exceptions" => 0, //Manejo de todas las excepciones
            'trace' => 1 //Se le da trazabilidad para debugguear
        ];

        $client = new \SoapClient($servicio, $params);

        //El namespace es estrictamente http://servientrega.com/
        $header = new \SoapHeader('http://servientrega.com/', 'Header');
        $client->__setSoapHeaders($header);
        foreach ($guias as $guia) {
        	$moves=null;
            $params_body = ['ConsultarGuia' => [
                //'ID_Cliente' => '900413155',
                'NumeroGuia' => $guia->numero
            ]];

			echo "numero guia: ".$guia->numero."</br>";
            $response = $client->__soapCall('ConsultarGuia', $params_body);

            //dd($response);
            if($response->ConsultarGuiaResult){
                $movimientos = $response->ConsultarGuiaResult->Mov->InformacionMov;
				//dd($movimientos);
				echo "dimension: ".count($movimientos)."</br>";
				
				if(count($movimientos)==1)
					$moves[0] = $movimientos;
				else
					$moves = $movimientos;
				//dd("");
				/*foreach ($moves as $estado) {
					echo "Print Estado:<pre>";
					print_r($estado);
					echo "</pre>";
					}
				dd("Linea 436");*/
                foreach ($moves as $estado) {
                	echo "Print Estado:";
                    //dd($estado);
                    $estado_guia = new EstadoGuiaOperadorLogistico();
                    
                    $estado_guia->estado = $estado->NomMov;
                    $estado_guia->descripcion = $estado->DesMov;
                    $estado_guia->id_estado = $estado->IdProc;
                    $estado_guia->fecha = null;
                    if ($estado->FecMov) {
                        $fecha = strtotime($estado->FecMov);
                        $fecha = date('Y-m-d H:i:s', $fecha);
                        $estado_guia->fecha = $fecha;
                    }
					//dd($estado_guia);
                    $estado_guia->guia_id = $guia->id;
					//dd($estado_guia);
					//var_dump($estado_guia);
                    //se busca un estado con los mismos datos para la misma guía
                    $estado_guia_duplicado = EstadoGuiaOperadorLogistico::
                    where('estado', $estado_guia->estado)
                        ->where('descripcion', $estado_guia->descripcion)
                        ->where('id_estado', $estado_guia->id_estado)
                        ->where('fecha', $estado_guia->fecha)
                        ->where('guia_id', $estado_guia->guia_id)->first();

                    if (!$estado_guia_duplicado) {
                        $estado_guia->save();
                        echo "estado tracking: ".$estado->NomMov."/br";
                        $nombre_estado_ol = NombreEstadoOperadorLogistico::where('nombre', $estado_guia->estado)
                            ->where('operador_logistico_id', $guia->operador_logistico_id)->first();
                        echo "estado OL: ".$nombre_estado_ol;
                        if ($nombre_estado_ol) {
                            $estado_guia->nombre_estado_operador_logistico_id = $nombre_estado_ol->id;
                            $estado_guia->save();
                            $estado_ol = $nombre_estado_ol->estadoOperadorLogistico;

                            $pedidos = $guia->pedidos;
                            if ($estado_ol->cambio_estado_pedido_id) {
                                $estado_cambio = EstadoPedido::find($estado_ol->cambio_estado_pedido_id);
                                foreach ($pedidos as $p) {
                                    if ($estado_cambio->notificacion_correo == 'si') {
                                        Correo::cambioEstadoEnSistema($p, $estado_cambio);
                                    } else if ($estado_ol->notificacion_correo == 'si') {
                                        Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                    }
                                    if ($estado_cambio->notificacion_push == 'si') {
                                        NotificacionPush::cambioEstado($p, $estado_cambio, $estado_cambio->nombre);
                                    } else if ($estado_ol->notificacion_push == 'si') {
                                        NotificacionPush::cambioEstado($p, $estado_ol, $estado_ol->nombre);
                                    }
                                    $p->estadosPedidos()->save($estado_cambio);
                                    if ($estado_guia->estado == 'novedad') {
                                        $p->novedad = $estado_guia->novedad;
                                        $p->save();
                                    }
                                }
                                if ($estado_cambio->pedido_entregado == 'si') {
                                    $guia->estado = 'entregada';
                                    $guia->save();
                                }
                            } else {
                                foreach ($pedidos as $p) {
                                    if ($estado_ol->notificacion_correo == 'si') {
                                        Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                    }

                                    if ($estado_ol->notificacion_push == 'si') {
                                        NotificacionPush::cambioEstado($p, $estado_ol, $estado_ol->nombre);
                                    }
                                }
                            }

                        }
                    }
                }
            }
        }

        return ['error' => $error, 'errores' => $errores];
    }


     public static function trackingDeprisaPruebas($guias)
    {
        set_time_limit(0);
        $errores = [];
        $error = true;


        $url = 'https://conectados.avianca.com/conecta2/seam/resource/restv1/tracking/';

        $headers = [
            'Content-Type' => 'application/xml'
        ];

        $client = new Client(
            [
                'base_uri' => $url,
                'http_errors' => false,
            ]);

        foreach ($guias as $guia) {
            $response = $client->request('GET', $guia->numero, [
                'headers' => $headers,
            ]);

            $stream_body = Psr7\stream_for($response->getBody());


            if ($response->getStatusCode() == '404') {
                $errores[] = 'No se encontro ninguna guía con el número ' . $guia->numero . '.';
            } else if ($response->getStatusCode() == '400') {
                $errores[] = 'El número de guía ' . $guia->numero . ' es incorrecto (mínimo 6 caracteres).';
            } else if ($response->getStatusCode() == '500') {
                $errores[] = 'Ocurrio un error interno del servidor de consulta al procesaro la guía No. ' . $guia->numero . '.';
            } else if ($response->getStatusCode() == '200') {
                $xml_body = simplexml_load_string($stream_body);
                // dd($xml_body->INCIDENCIAS);

                if ($xml_body->INCIDENCIAS && $xml_body->INCIDENCIAS->INCIDENCIA) {


                    $incidencias = $xml_body->INCIDENCIAS;
                    if ($incidencias && $incidencias->INCIDENCIA) {

                        foreach ($incidencias->INCIDENCIA as $incidencia) {
                            $estado_guia = new EstadoGuiaOperadorLogistico();
                            $estado_guia->id_estado = null;
                            $estado_guia->descripcion = (string)$incidencia->DESCRIPCION;
                            $estado_guia->guia_id = $guia->id;
                            $estado_guia->novedad = (string)$incidencia->DESCRIPCION;
                            $estado_guia->estado = 'novedad';
                            $fecha = \DateTime::createFromFormat('d/m/Y H:i', $incidencia->FECHA_ALTA);
                            $fecha = $fecha->format('Y-m-d H:i:s');
                            $estado_guia->fecha = $fecha;

                            $estado_guia_duplicado = EstadoGuiaOperadorLogistico::
                            where('estado', $estado_guia->estado)
                                ->where('descripcion', $estado_guia->descripcion)
                                ->where('id_estado', $estado_guia->id_estado)
                                ->where('fecha', $estado_guia->fecha)
                                ->where('guia_id', $estado_guia->guia_id)->first();

                            if (!$estado_guia_duplicado) {
                                //dd($estado_guia_duplicado);
                                $estado_guia->save();
                                $nombre_estado_ol = NombreEstadoOperadorLogistico::where('nombre', $estado_guia->estado)
                                    ->where('operador_logistico_id', $guia->operador_logistico_id)->first();
                                //dd($nombre_estado_ol);
                                if ($nombre_estado_ol) {
                                    $estado_guia->nombre_estado_operador_logistico_id = $nombre_estado_ol->id;
                                    $estado_guia->save();
                                    $estado_ol = $nombre_estado_ol->estadoOperadorLogistico;

                                    $pedidos = $guia->pedidos;
                                    if ($estado_ol->cambio_estado_pedido_id) {
                                        $estado_cambio = EstadoPedido::find($estado_ol->cambio_estado_pedido_id);
                                        foreach ($pedidos as $p) {
                                            if ($estado_cambio->notificacion_correo == 'si') {
                                                Correo::cambioEstadoEnSistema($p, $estado_cambio);
                                                echo "<br>Enviando correo Cambio de Estado en Sistema";
                                            } else if ($estado_ol->notificacion_correo == 'si') {
                                                Correo::cambioEstadoEnOL($p, $estado_ol, $guia->operadorLogistico);
                                                echo "<br>Enviando correo Cambio de Estado en Operador Logistico";
                                            }
                                            if ($estado_cambio->notificacion_push == 'si') {
                                                NotificacionPush::cambioEstado($p, $estado_cambio, $estado_cambio->nombre);
                                                echo "<br>Enviando Notificacion Push en Cambio de Estado";
                                            } else if ($estado_ol->notificacion_push == 'si') {
                                                NotificacionPush::cambioEstado($p, $estado_ol, $estado_ol->nombre);
                                                 echo "<br>Enviando Notificacion Push en Cambio de Estado OL";
                                            }
                                            $p->estadosPedidos()->save($estado_cambio);
                                            if ($estado_guia->estado == 'novedad') {
                                                $p->novedad = $estado_guia->novedad;
                                                $p->save();
                                            }
                                            /* echo "<pre>";
                                             print_r($p);
                                             echo "</pre>";*/
                                        }

                                    }
                                }
                            }else{
                            	echo "Ya existe la novedad...";
                            }
                        }

                    }


                }


            }
        }

        return ['error' => $error, 'errores' => $errores];
    }

}