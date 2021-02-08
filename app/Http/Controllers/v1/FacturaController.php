<?php

namespace FuxionLogistic\Http\Controllers\v1;

use Illuminate\Http\Request;
use FuxionLogistic\Models\Pedido;
use Illuminate\Support\Facades\DB;
use FuxionLogistic\Models\Empresario;
use FuxionLogistic\Http\Controllers\Controller;

class FacturaController extends Controller
{
    //
    public function  getFactura(Request $r){

        $guia = $r->input("guia");
        $cambio = $r->input("estado");
        
        $pedidos = Pedido::select("pedidos.*","guias_pedidos.id as gp_id","pedidos.id as pedido_id","t1.razon_estado as razon_estado","t1.estado_pedido_id as estado_pedido_id","usuarios_exigo.nombre_impreso", "usuarios_exigo.rango_desde", "usuarios_exigo.rango_hasta","usuarios_exigo.resolucion","usuarios_exigo.fecha_resolucion","usuarios_exigo.direccion_factura" )
            ->join("guias_pedidos","pedidos.id","=","guias_pedidos.pedido_id")
            ->join("guias","guias_pedidos.guia_id","=","guias.id")
            ->join("usuarios_exigo","pedidos.serie","=","usuarios_exigo.serie")
            ->leftJoin(DB::raw("(SELECT
                                    razon_estado,
                                    estado_pedido_id,
                                    pedido_id as pid
                                    FROM
                                v_historial_estados_pedido hep
                            WHERE
                                hep.historial_estado_pedido_id in (SELECT 
                                        MAX(id) AS max_id
                                    FROM
                                        historial_estados_pedidos he group by pedido_id)
                                    ) as t1"),"t1.pid","=","pedidos.id")
            ->where("guias.numero",$guia)->get();

        $empresario = Empresario::select("empresarios.*","users.*")
            ->join("pedidos","pedidos.empresario_id","=","empresarios.id")
            ->join("guias_pedidos","pedidos.id","=","guias_pedidos.pedido_id")
            ->join("guias","guias_pedidos.guia_id","=","guias.id")
            ->join("users","users.id","=","empresarios.user_id")
            ->where("guias.numero",$guia)->get();

        $productos = DB::select("select
                                        pr.*,
                                        pp.*,
                                        pr.id as producto_id
                                    from
                                        pedidos_productos pp
                                            inner join productos pr on pr.id=pp.producto_id
                                            inner join pedidos pe on pe.id=pp.pedido_id
                                            inner join guias_pedidos gp on gp.pedido_id = pe.id
                                            inner join guias g on g.id = gp.guia_id
                                            where g.numero = '".$guia."'");


        return view('factura.index', [ 'pedidos' => $pedidos, 'empresario' => $empresario , 'productos' => $productos, 'cambio' => $cambio=="true"? true : false  ]);
        //return response(["data" => $data, "empresario" => $empresario, "productos" => $productos]);
    }
}
