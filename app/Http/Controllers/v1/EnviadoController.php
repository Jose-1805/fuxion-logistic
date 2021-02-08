<?php

namespace FuxionLogistic\Http\Controllers\v1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use FuxionLogistic\Http\Controllers\Controller;

class EnviadoController extends Controller
{
    //
    public function store(Request $request){

        $productos = json_decode($request->input("productos"));
      //  $guia_pedido_id = $request->input("guia_pedido_id");

        if(isset($productos)) {
            //dd($productos);

            //$sql = "insert into productos_enviados (cantidad, producto_id, guia_pedido_id) values ";
            foreach ($productos as $producto) {
                $sql = "insert into productos_enviados (cantidad, producto_id, guia_pedido_id) values ";
                $sql .= "('" . $producto->envio . "','" . $producto->producto_id . "','" . $producto->guia_pedido_id . "') ON DUPLICATE KEY UPDATE cantidad='".$producto->envio."';";
                //$sql = substr($sql, 0, -1);
                DB::statement($sql);
            }

            return response(["productos" => $productos]);
        }
        else
            return response(['error'=>['La información enviada es incorrecta']],422);
    }

    public function deleteEnviosPorGuia(Request $r){
        //Si es editable es porque llega sin productos con cantidades editadas
        if($r->input("editable")=='true') {
            $pedidos = DB::select("select 
                                        * 
                                    from 
                                        v_guias_pedidos_corte
                                     where numero_guia='" . $r->input("guia") . "'
                                                 ");

            foreach ($pedidos as $pedido) {
                DB::statement("DELETE FROM productos_enviados WHERE guia_pedido_id = '$pedido->guia_pedido_id'");
                //echo "DELETE FROM productos_enviados WHERE guia_pedido_id = '$pedido->guia_pedido_id'";
            }
        }
       // dd("Ok");
        return response(['success'=>['ok']],200);
    }
}
