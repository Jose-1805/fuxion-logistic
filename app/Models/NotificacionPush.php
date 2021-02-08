<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class NotificacionPush extends Model
{


    private static function crear($titulo = '', $mensaje = '', $destinatario)
    {
        $url = 'https://fcm.googleapis.com/fcm/';

        $headers = [
            'Authorization' => 'key=AIzaSyAObybIUKUk_Z3I0Tcn9Wk02Cl3eXEG2zY',
            'Content-Type' => 'application/json'
        ];
        $client = new Client(['base_uri' => $url]);

        $body = [
            'to'=>$destinatario,
            'content_available'=>true,
            'notification'=>[
                'title'=>$titulo,
                'body'=>$mensaje,
                'sound'=>'default'
            ]
        ];

        //echo 'llamando';
        $response = $client->request('POST', 'send', [
            'headers' => $headers,
            'body' => \GuzzleHttp\json_encode($body)
        ]);
        //echo 'despues de llamado';
        //dd($response);
        if($response->getStatusCode() == '200')
            return ['success' => true];

        return ['success'=>false];
    }

    public static function cambioEstado(Pedido $pedido, $estado, $nombre_estado){
        if($estado->notificacion_push == 'si'){
            $destinatario = $pedido->empresario->user;
            if($destinatario->token_fcm) {
                $titulo = 'Fuxion Express';
                $mensaje = 'Estado de pedido con factura N° ' . $pedido->serie . '-' . $pedido->correlativo . ' cambiado a ' . $nombre_estado;
                return  Self::crear($titulo, $mensaje, $destinatario->token_fcm);
            }
        }
        return ['success'=>false];
    }

}