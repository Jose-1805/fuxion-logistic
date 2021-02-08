<?php

namespace FuxionLogistic\Console;

use FuxionLogistic\Console\Commands\CorteEstadoPermanente;
use FuxionLogistic\Console\Commands\EnviarCorreos;
use FuxionLogistic\Console\Commands\PedidosACola;
use FuxionLogistic\Console\Commands\Tracking;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        EnviarCorreos::class,
        PedidosACola::class,
        Tracking::class,
        CorteEstadoPermanente::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pedidos-a-cola')
				->weekly()->mondays()->at('23:00');
        $schedule->command('enviar-correos')
            ->everyMinute();
        $schedule->command('tracking')
            ->cron('*/15 * * * *');
        $schedule->command('corte-estado-permanente')
            ->cron('*/15 * * * *');

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
/*
 *
 * public function setEstado(Request $r){

        $pedidos = DB::select("select
                                    *
                                from
                                    v_guias_pedidos_corte
                                 where numero_guia='".$r->input("guia")."'
                                             ");

        $respuesta = "";
        foreach ($pedidos as $pedido){


            if($r->input("cambiado")=='true') {
                $conteo = DB::select("select count(*) as total from v_productos_enviados where pedido_id='" . $pedido->pedido_id . "'  ");

                if($conteo[0]->total>0) {
                    $respuesta = "Cambio de estado del pedido $pedido->pedido_id a Pendiente por productos";
                    DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id, razon_estado, created_at) values ('$pedido->pedido_id','8','Pendiente por productos','" . date("Y-m-d h:i:s") . "')");
                    $pedido_obj = Pedido::find($pedido->pedido_id);
                    $guia = Guia::find($pedido->guia_id);
                    Correo::pedidoEnviadoEmpresario($pedido_obj->empresario,$pedido_obj,$guia);
                }
                else {
                    $respuesta = "Cambio de estado del pedido $pedido->pedido_id a Enviado";
                    DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id, created_at) values ('$pedido->pedido_id','11','" . date("Y-m-d h:i:s") . "')");
                }
            }else{
                $respuesta = "Cambio de estado del pedido $pedido->pedido_id a Enviado";
                DB::statement("insert into historial_estados_pedidos (pedido_id, estado_pedido_id, created_at) values ('$pedido->pedido_id','11','" . date("Y-m-d h:i:s") . "')");
                $pedido_obj = Pedido::find($pedido->pedido_id);
                $guia = Guia::find($pedido->guia_id);
                Correo::pedidoEnviadoEmpresario($pedido_obj->empresario,$pedido_obj,$guia);
            }
        }


        return response([ "data" => $respuesta, 'success' => true ]);
    }*/