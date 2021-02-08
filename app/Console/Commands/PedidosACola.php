<?php

namespace FuxionLogistic\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PedidosACola extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pedidos-a-cola';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        echo 'Iniciando proceso...';
        DB::statement('INSERT INTO historial_estados_pedidos(pedido_id,estado_pedido_id,razon_estado)
            SELECT C.pedido_id,8,NULL from
            ( select pedido_id from v_historial_estados_pedido where 
			historial_estado_pedido_id in
			(SELECT
				MAX(id) AS max_id
				FROM fuxion_logistic.historial_estados_pedidos
				GROUP BY pedido_id) and estado_pedido_id=8 and razon_estado=\'Pendiente por kit\' and
			  ( fecha_orden between DATE_ADD(curdate(), INTERVAL -13 DAY) and DATE_ADD(curdate(), INTERVAL -7 DAY)) ) C');
        echo 'Proceso terminado con éxito';
    }
}
