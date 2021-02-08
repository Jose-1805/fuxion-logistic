<?php

namespace FuxionLogistic\Console\Commands;

use FuxionLogistic\Models\Guia;
use Illuminate\Console\Command;

class Tracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracking';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Revisa y actualiza los estados de las guias comparando con los estados retornados por los operadores logistícos';

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
        Guia::tracking();
    }
}
