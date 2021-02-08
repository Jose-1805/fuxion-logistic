<?php

namespace FuxionLogistic\Console\Commands;

use FuxionLogistic\Models\Corte;
use Illuminate\Console\Command;

class CorteEstadoPermanente extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'corte-estado-permanente';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consulta cortes que tengan el estado en proceso por más de 24 horas y envia notificación por email para usuarios de perfil logistica';

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
        Corte::alertaCortePermanenteProcesado();
    }
}
