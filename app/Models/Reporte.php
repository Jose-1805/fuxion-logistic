<?php
/**
 * Created by PhpStorm.
 * User: Desarrollador 1
 * Date: 19/12/2017
 * Time: 3:39 PM
 */

namespace FuxionLogistic\Models;


use Illuminate\Support\Facades\DB;

class Reporte
{
    public static function logistica($fecha_inicio,$fecha_fin){
        $sql = "
            SELECT P.fecha_orden,concat(P.serie,\"-\",P.correlativo) as factura, P.orden_id,E.empresario_id,
            f1.created_at as fecha_proceso,f2.created_at as fecha_envio, f3.created_at as fecha_entregado,
			guias.numero as numero_guia,            
            f7.created_at as fecha_devolucion, operadores_logisticos.nombre, ciudades.nombre as ciudad,departamentos.nombre as departamento,SC.nombre as estado, SC.descripcion
            FROM guias inner join guias_pedidos on guias.id=guias_pedidos.guia_id
            inner join pedidos P on P.id=guias_pedidos.pedido_id
            inner join empresarios E on E.id=P.empresario_id
            inner join ciudades on P.ciudad_id = ciudades.id
            inner join departamentos on P.departamento_id = departamentos.id
            inner join operadores_logisticos on operadores_logisticos.id=guias.operador_logistico_id
            left join (select h1.pedido_id, h1.created_at from historial_estados_pedidos h1  where h1.estado_pedido_id=9 and h1.razon_estado is null  ) f1 on P.id=f1.pedido_id
            
            left join (select h2.pedido_id, h2.created_at from historial_estados_pedidos h2  where h2.estado_pedido_id=11) f2 on P.id=f2.pedido_id
            
            left join (select h3.pedido_id, h3.created_at from historial_estados_pedidos h3  where h3.estado_pedido_id=12) f3 on P.id=f3.pedido_id
            
            left join (select h7.pedido_id, h7.created_at from historial_estados_pedidos h7  where h7.estado_pedido_id=8 and h7.razon_estado='Pendiente por devolucion') f7
            
            on P.id=f7.pedido_id
            
            left join (select SC1.pedido_id,ep.nombre,ep.descripcion,SC1.razon_estado from
            (select * from historial_estados_pedidos hep where hep.id in (
            
            select max(hep1.id) from historial_estados_pedidos hep1 group by hep1.pedido_id)) SC1 inner join
            
            estados_pedidos ep on ep.id=SC1.estado_pedido_id) SC on SC.pedido_id=P.id
            where P.fecha_orden between '$fecha_inicio' and '$fecha_fin'
        ";
        return DB::select($sql);
    }

    public static function incidencias($fecha_inicio,$fecha_fin){
        $sql = "            
            SELECT P.fecha_orden,concat(P.serie,'-',P.correlativo) as factura, P.orden_id,E.empresario_id,
            f4.fecha fecha_novedad,f4.descripcion as descripcion,guias.numero as numero_guia
            FROM guias inner join guias_pedidos on guias.id=guias_pedidos.guia_id
            inner join pedidos P on P.id=guias_pedidos.pedido_id
            inner join empresarios E on E.id=P.empresario_id
            inner join operadores_logisticos on operadores_logisticos.id=guias.operador_logistico_id
            inner join (select h4.fecha, h4.guia_id,h4.estado,h4.descripcion from estados_guias_operadores_logisticos h4  where  h4.estado='novedad'  )
            f4 on guias.id=f4.guia_id
            where P.fecha_orden between '$fecha_inicio' and '$fecha_fin'
            order by P.orden_id,f4.fecha
        ";
        return DB::select($sql);
    }

    public static function pedidosProductos($fecha_inicio,$fecha_fin){
        $sql = "
            SELECT P.fecha_orden,concat(P.serie,'-',P.correlativo) as factura, P.orden_id,E.empresario_id,c.numero as numero_corte,
            pr.codigo as codigo_producto, pr.descripcion as descripcion_producto, pp.cantidad as cantidad, pp.precio_unitario as precio_unitario, pp.total as precio_total,
            SC.nombre as estado,SC.razon_estado as razon_estado
            FROM pedidos P 
            inner join empresarios E on E.id=P.empresario_id
            inner join pedidos_productos pp on pp.pedido_id=P.id
            inner join productos pr on pr.id=pp.producto_id
            left join cortes c on c.id=P.corte_id
            left join (select SC1.pedido_id,ep.nombre,ep.descripcion,SC1.razon_estado from
            (select * from historial_estados_pedidos hep where hep.id in ( 
            select max(hep1.id) from historial_estados_pedidos hep1 group by hep1.pedido_id)) SC1 inner join    
            estados_pedidos ep on ep.id=SC1.estado_pedido_id) SC on SC.pedido_id=P.id
            where P.fecha_orden between '$fecha_inicio' and '$fecha_fin'
            order by orden_id, c.numero
        ";
        return DB::select($sql);
    }

    public static function tiemposLogistica($fecha_inicio,$fecha_fin){
        $sql = "
            SELECT P.fecha_orden,concat(P.serie,'-',P.correlativo) as factura, P.orden_id,E.empresario_id,
            TIMESTAMPDIFF(MINUTE,P.fecha_orden,f2.created_at) as tiempo_salida_bodega,TIMESTAMPDIFF(MINUTE,f2.created_at,f3.created_at) as tiempo_entrega,
            guias.numero as numero_guia,
              ciudades.nombre as ciudad,departamentos.nombre as departamento,operadores_logisticos.nombre
            FROM guias inner join guias_pedidos on guias.id=guias_pedidos.guia_id
            inner join pedidos P on P.id=guias_pedidos.pedido_id
            inner join empresarios E on E.id=P.empresario_id
            inner join ciudades on P.ciudad_id = ciudades.id
            inner join departamentos on P.departamento_id = departamentos.id
            inner join operadores_logisticos on operadores_logisticos.id=guias.operador_logistico_id
            left join (select h1.pedido_id, h1.created_at from historial_estados_pedidos h1  where h1.estado_pedido_id=9 and h1.razon_estado is null  ) f1 on P.id=f1.pedido_id
            
            left join (select h2.pedido_id, h2.created_at from historial_estados_pedidos h2  where h2.estado_pedido_id=11) f2 on P.id=f2.pedido_id
            
            left join (select h3.pedido_id, h3.created_at from historial_estados_pedidos h3  where h3.estado_pedido_id=12) f3 on P.id=f3.pedido_id
            
            left join (select h7.pedido_id, h7.created_at from historial_estados_pedidos h7  where h7.estado_pedido_id=8 and h7.razon_estado='Pendiente por devolucion') f7
            on P.id=f7.pedido_id
            where P.fecha_orden between '$fecha_inicio' and '$fecha_fin'
        ";
        return DB::select($sql);
    }
}