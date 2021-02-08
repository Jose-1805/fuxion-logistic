<?php

namespace FuxionLogistic\Http\Controllers\v1;

use FuxionLogistic\Models\Correo;
use FuxionLogistic\Models\Corte;
use FuxionLogistic\Models\Empresario;
use FuxionLogistic\Models\EstadoPedido;
use FuxionLogistic\Models\Guia;
use FuxionLogistic\Models\NotificacionPush;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use FuxionLogistic\Models\Pedido;
use FuxionLogistic\Http\Controllers\Controller;
use Yajra\Datatables\Request;

class PedidoController extends Controller
{
    //

 public function estructuraBarCode($barcode){

        if(strlen($barcode)>14){//Si la cadena de caracteres es más larga de 14 chars, es de deprisa

            return(substr($barcode,11,-3));//A partir del 4 caracter hasta 5 para llegar al final

        }else{//Si es más corta, es de servientrega
            return $barcode;
        }

    }

    public function getPedido($barcode,$corte_id)
    {
    	 $barcode = $this->estructuraBarCode($barcode);
    	// echo "BARCODE::::::".$barcode;    
        $pedidos = Pedido::select("pedidos.*","guias.*","t1.razon_estado as razon_estado", "guias_pedidos.id as guia_pedido_id","pedidos.id as pedido_id")
            ->join("guias_pedidos","pedidos.id","=","guias_pedidos.pedido_id")
            ->join("guias","guias_pedidos.guia_id","=","guias.id")
            ->join("cortes","pedidos.corte_id","=","cortes.id")
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
            ->where("guias.numero",$barcode)
            ->where("t1.estado_pedido_id","9")
            ->where("cortes.id",$corte_id)
            ->get();

        $empresario = Empresario::select("empresarios.*","users.*","ciudades.nombre as ciudad","pedidos.direccion","pedidos.email")
            ->join("pedidos","pedidos.empresario_id","=","empresarios.id")
            ->join("guias_pedidos","pedidos.id","=","guias_pedidos.pedido_id")
            ->join("guias","guias_pedidos.guia_id","=","guias.id")
            ->join("users","users.id","=","empresarios.user_id")
			->join("ciudades","ciudades.id","=","pedidos.ciudad_id")
            ->where("guias.numero",$barcode)->first();

        $productos = DB::select("select
                                        pr.*,
                                        pp.*,
                                        pr.id as producto_id,
                                        pe.id as pedido_id,
                                        gp.id as guia_pedido_id
                                    from
                                        pedidos_productos pp
                                            inner join productos pr on pr.id=pp.producto_id
                                            inner join pedidos pe on pe.id=pp.pedido_id
                                            inner join guias_pedidos gp on gp.pedido_id = pe.id
                                            inner join guias g on g.id = gp.guia_id
                                            where g.numero = '".$barcode."'  and pr.codigo <> 'DSCT' order by pe.id ");




        return response(["data" => $pedidos, "empresario" => $empresario, "productos" => $productos  ]);
    }


    public function getDevolucion($barcode)
    {

		$barcode = $this->estructuraBarCode($barcode);
		
        $pedidos = Pedido::select("pedidos.*","guias.*", "guias_pedidos.id as guia_pedido_id", "pedidos.id as pedido_id")
            ->join("guias_pedidos","pedidos.id","=","guias_pedidos.pedido_id")
            ->join("guias","guias_pedidos.guia_id","=","guias.id")
            ->where("guias.numero",$barcode)
            ->get();

        $empresario = Empresario::select("empresarios.*","users.*","ciudades.nombre as ciudad","pedidos.direccion","pedidos.email")
            ->join("pedidos","pedidos.empresario_id","=","empresarios.id")
            ->join("guias_pedidos","pedidos.id","=","guias_pedidos.pedido_id")
            ->join("guias","guias_pedidos.guia_id","=","guias.id")
            ->join("users","users.id","=","empresarios.user_id")
			->join("ciudades","ciudades.id","=","pedidos.ciudad_id")
            ->where("guias.numero",$barcode)->get();

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
                                            where g.numero = '".$barcode."'  and pr.codigo <> 'DSCT' ");

        // dd($corte_id);

        return response(["data" => $pedidos, "empresario" => $empresario, "productos" => $productos]);
    }
    
    public function setIngreso(Request $r){
        $ids = json_decode($r->input("id"));

        //dd($ids);
        if(isset($ids)) {
            foreach ($ids as $id) {
                DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id,razon_estado, created_at) values ('" . $id->id . "','8','Ingresado a bodega','" . date("Y-m-d H:i:s") . "')");

            }

            return response(['success' => true]);
        }
    }

    public function setEstado(Request $r){

        $pedidos = DB::select("select
                                    *
                                from
                                    v_guias_pedidos_corte
                                 where numero_guia='".$r->input("guia")."'
                                             ");

        $respuesta = "";
        $corte_id=0;
        foreach ($pedidos as $pedido){


            if($r->input("cambiado")=='true') {
                $conteo = DB::select("select count(*) as total from v_productos_enviados where pedido_id='" . $pedido->pedido_id . "'  ");

                if($conteo[0]->total>0) {
                    $respuesta .= "Cambio de estado del pedido $pedido->pedido_id a Pendiente por productos";
                    DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id, razon_estado, created_at) values ('$pedido->pedido_id','8','Pendiente por productos','" . date("Y-m-d H:i:s") . "')");
                    $pedido_obj = Pedido::find($pedido->pedido_id);
                    $guia = Guia::find($pedido->guia_id);
                    Correo::pedidoEnviadoEmpresario($pedido_obj->empresario,$pedido_obj,$guia);
                }
                else {
                    $respuesta .= "Cambio de estado del pedido $pedido->pedido_id a Enviado";
                    DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id, created_at) values ('$pedido->pedido_id','11','" . date("Y-m-d H:i:s") . "')");
                    $estado = EstadoPedido::find(11);
                    $pedido_obj = Pedido::find($pedido->pedido_id);
                    $guia = Guia::find($pedido->guia_id);
                    Correo::pedidoEnviadoEmpresario($pedido_obj->empresario,$pedido_obj,$guia);
                    NotificacionPush::cambioEstado($pedido_obj,$estado,$estado->nombre);
                }
            }else{
                $respuesta .= "Cambio de estado del pedido $pedido->pedido_id a Enviado";
                DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id, created_at) values ('$pedido->pedido_id','11','" . date("Y-m-d H:i:s") . "')");
                $estado = EstadoPedido::find(11);
                $pedido_obj = Pedido::find($pedido->pedido_id);
                $guia = Guia::find($pedido->guia_id);
                Correo::pedidoEnviadoEmpresario($pedido_obj->empresario,$pedido_obj,$guia);
                NotificacionPush::cambioEstado($pedido_obj,$estado,$estado->nombre);
            }
             $corte_id=$pedido->corte_id;
        }
 $mensaje="El corte está enviado!!";
        $filas = 0;
        $vista = "scanner";//Esta variable controla la vista a mostrar en la app. Si continua escaneando o si pasa a la lista de cortes

        //Si hay un corte_id válido, es decir, el corte aún no está enviado
        if($corte_id>0) {
            $mensaje = $respuesta;

            if (count($pedidos) > 0)
                $mensaje .= "Hubo actualización de" . count($pedidos) . " pedidos...";

            $res = DB::select("select count(*) as en_cola, corte_id from v_historial_estados_pedido
                                where 
                                    historial_estado_pedido_id in
                                    (SELECT 
                                    MAX(id) AS max_id
                                FROM
                                    fuxion_logistic.historial_estados_pedidos
                                GROUP BY pedido_id) and estado_pedido_id='9' /* and user_id='" . Auth::user()->id . "' */
                                and  corte_id='$corte_id' group by corte_id limit 1");


            //Si no hay más pedidos en cola en el corte, se actualiza el estado del mismo a enviado, para liberar otro corte

            if (!isset($res[0]->en_cola)) {
                $filas = DB::statement("update cortes set estado='enviado' where id='" . $corte_id . "' ");
                $vista = "cortes";
            }

            if($filas>0)
                $mensaje .= "Se actualizó el estado del corte correctamente...";
            else
                $mensaje .= "No hubo actualización de estado del corte...";
        }



//        $filas=DB::statement("update cortes set estado='enviado' where id='".$id."' ");




        return response([ "data" => $respuesta, 'success' => $mensaje, 'vista' => $vista ]);
    }

    public function getConsolidado($corte){
        $en_cola=DB::select("select count(*) as en_cola from v_historial_estados_pedido
                                where 
                                    historial_estado_pedido_id in
                                    (SELECT 
                                    MAX(id) AS max_id
                                FROM
                                    fuxion_logistic.historial_estados_pedidos
                                GROUP BY pedido_id) and corte_id='".$corte."' and estado_pedido_id='9' /*and user_id='".Auth::user()->id."'*/ ");


        $total=DB::select("select count(*) as total from v_historial_estados_pedido
                                where 
                                    historial_estado_pedido_id in
                                    (SELECT 
                                    MAX(id) AS max_id
                                FROM
                                    fuxion_logistic.historial_estados_pedidos
                                GROUP BY pedido_id) and corte_id='".$corte."' /* and user_id='".Auth::user()->id."'*/ ");

        return response(["en_cola" => is_null($en_cola[0]->en_cola)?0:is_null($en_cola[0]->en_cola)?0:$en_cola[0]->en_cola, "total" => $total[0]->total ]);
        //return response(["en_cola" => $en_cola[0]->en_cola, "total" => $total[0]->total ]);
    }

    public function getPedidosExpress($pag){
        $pedidos = DB::select("SELECT *, vegol.alias_eol as nombre 
                	FROM fuxion_logistic.v_estados_gol vegol 
                 	inner JOIN
                                empresarios e ON e.id = vegol.empresario_id
                				where e.user_id = ".Auth::user()->id." 
                				and vegol.id IN (SELECT 
                                        MAX(id) AS max_id
                                    FROM
                                        estados_guias_operadores_logisticos ego
                                    GROUP BY guia_id)
                				
                				limit ".($pag*10).",10
                                  
                                 ");

        //$total_pedidos = DB::select("select count(*) as total_pedidos from v_guias_pedidos_corte where user_id='".Auth::user()->id."'");
        $total_pedidos = DB::select("select count(*) as total_pedidos from v_user_empresario_pedido  where users_id='".Auth::user()->id."' ");
       // $en_curso = DB::select("SELECT count(*) as en_curso  FROM v_estados_gol vegol inner join empresarios e on e.id=vegol.empresario_id where alias_eol<>'entregado' and  user_id='".Auth::user()->id."'");
        
        $en_curso= DB::select("SELECT 
                                COUNT(*) as en_curso
                            FROM
                                v_estados_gol vegol
                                    INNER JOIN
                                empresarios e ON e.id = vegol.empresario_id
                            WHERE
                                vegol.id IN (SELECT 
                                        MAX(id) AS max_id
                                    FROM
                                        estados_guias_operadores_logisticos ego
                                    GROUP BY guia_id)
                                    and alias_eol<>'Entregado'
                                    and e.user_id = '".Auth::user()->id."'

                            ");

        $nombres = DB::select("select CONCAT(nombres,' ',ifnull(apellidos,'')) as nombres from v_user_empresario_pedido where users_id='".Auth::user()->id."'");
        
        return response(['pedidos' =>  $pedidos, 'total_pedidos'=>$total_pedidos, 'en_curso' => $en_curso, "nombres" => $nombres ],200);
    }
    
    public function getProductosExpress($pedido){
       // $productos=DB::select("select * from v_pedidos_productos vpp where pedido_id='$pedido' and cantidad<>-1");
    	 $productos=DB::select("select * from v_pedidos_productos vpp where pedido_id='$pedido' and codigo<>'DSCT'");

        $datos = DB::select("select 
                              alias_eol as estado_alias,
                              nombre_estado_eol as estado,
                              concat(fecha_ego,' ',hora_ego) as fecha,
                              ol.nombre as operador,
                               'No registra' as recibido_por
                              from v_estados_gol vegol
                                    INNER JOIN
                                empresarios e ON e.id = vegol.empresario_id
                                    INNER JOIN
                                operadores_logisticos ol on ol.id = vegol.operador_id_g
                            WHERE
                                vegol.id IN (SELECT 
                                        MAX(id) AS max_id
                                    FROM
                                        estados_guias_operadores_logisticos ego
                                    GROUP BY guia_id)
        					AND vegol.pedido_id='$pedido'
        					");

        return response(['productos' =>  $productos , "datos" => $datos],200);
    }


    public function getEstadosExpress($pedido){


        //$estados = DB::select("SELECT * FROM fuxion_logistic.v_estados_gol  order by id asc");
         $estados = DB::select("SELECT * FROM fuxion_logistic.v_estados_gol where pedido_id= '$pedido' order by id asc");

        $user_data = DB::select("select * from v_user_empresario_pedido where pedido_id = '$pedido'");

        $porc=DB::select("SELECT 
                            gp.pedido_id,
                            gp.guia_id,
                            `mc`.`tiempo_entrega`*1 AS `tiempo_entrega`, 
                            `ego`.`fecha`,
                            t1.fecha_inicio,
                            time_to_sec(timediff(t2.fecha_ultimo, t1.fecha_inicio )) / 3600 as horas_diferencia,
                            DATE_FORMAT((t1.fecha_inicio  + INTERVAL `mc`.`tiempo_entrega` HOUR),'%d/%m/%Y') AS `fecha_entrega`,
                            100-((`mc`.`tiempo_entrega`*1-time_to_sec(timediff(t2.fecha_ultimo, t1.fecha_inicio )) / 3600)/(`mc`.`tiempo_entrega`*1))*100 as porcentaje
                        FROM
                            estados_guias_operadores_logisticos ego
                                JOIN
                            `guias_pedidos` `gp` ON ego.`guia_id` = `gp`.`guia_id`
                                JOIN
                            `guias` `g` ON `g`.`id` = `gp`.`guia_id`
                                JOIN
                            `mallas_cobertura` `mc` ON `mc`.`id` = `g`.`malla_cobertura_id`
                                JOIN
                            `pedidos` `p` ON `p`.`id` = `gp`.`pedido_id`
                                LEFT JOIN
                            `nombres_estados_operadores_logisticos` `neol` ON `neol`.`id` = `ego`.`nombre_estado_operador_logistico_id`
                                LEFT JOIN
                            `estados_operadores_logisticos` `eol` ON `eol`.`id` = `neol`.`estado_operador_logistico_id`
                                JOIN 
                            (SELECT min(fecha) as fecha_inicio, guia_id from estados_guias_operadores_logisticos eg2 group by guia_id  ) as t1 ON t1.guia_id = gp.guia_id
                                JOIN 
                            (SELECT max(fecha) as fecha_ultimo, guia_id from estados_guias_operadores_logisticos eg2 group by guia_id  ) as t2 ON t2.guia_id = gp.guia_id
                            where pedido_id='$pedido' limit 1  ");

       // dd($porc[0]->porcentaje);
        //$porcentaje = rand(0,100);

        return response(['estados' => $estados, "user_data" => $user_data, "porcentaje" => $porc[0]->porcentaje ],200);
    }

}
