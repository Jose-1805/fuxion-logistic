<?php

namespace FuxionLogistic\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FuxionLogistic\Http\Controllers\Controller;

class GuiaController extends Controller
{

    public function actualizarOperador(Request $r){
        //Si es editable es porque llega sin productos con cantidades editadas

            //$pedidos = DB::statement("");

            //foreach ($pedidos as $pedido) {
               // DB::statement("DELETE FROM productos_enviados WHERE guia_pedido_id = '$pedido->guia_pedido_id'");
            //}
        $guias = json_decode($r->input("guias"));
        //  $guia_pedido_id = $request->input("guia_pedido_id");

        if(isset($guias)) {
            DB::beginTransaction();
            foreach ($guias as $guia) {
               DB::update("update guias set operador_logistico_id = '$guia->operador_id' where id='$guia->guia_id'");
            }
            DB::commit();
            return response(['success'=>['ok']],200);
        }

       // dd("Ok");

        //return response(["success" => $sql ]);
        return response(['Error'=>['No s']],400);
    }
}
