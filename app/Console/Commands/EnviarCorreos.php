<?php

namespace FuxionLogistic\Console\Commands;

use FuxionLogistic\Mail\PlantillaCorreo;
use FuxionLogistic\Models\Correo;
use FuxionLogistic\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnviarCorreos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar-correos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envío de correos almacenados en la base de datos';

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
        //primero se envian los prioritarios
        $correos = Correo::where('estado','pendiente')->where('tipo','prioritario')->get();
        echo count($correos).' Prioritarios ...';
        foreach ($correos as $correo){
            $remitentes = $correo->usuarios;
            if($correo->correos_destinatarios){
                $correos_destinatarios = explode(';',$correo->correos_destinatarios);
                foreach ($correos_destinatarios as $c){
                    $user = new User();
                    $user->email = $c;
                    $remitentes->push($user);
                }
            }
            Mail::to($remitentes)->send(new PlantillaCorreo($correo));
            $correo->estado = 'enviado';
            $correo->save();
        }

        //correos programados
        $correos = Correo::where('estado','pendiente')->where('tipo','programado')->where('fecha_programada','<=',date('Y-m-d'))->get();
        echo count($correos).' Programados ...';
        foreach ($correos as $correo){
            $remitentes = $correo->usuarios;
            if($correo->correos_destinatarios){
                $correos_destinatarios = explode(';',$correo->correos_destinatarios);
                foreach ($correos_destinatarios as $c){
                    $user = new User();
                    $user->email = $c;
                    $remitentes->push($user);
                }
            }
            Mail::to($remitentes)->send(new PlantillaCorreo($correo));
            $correo->estado = 'enviado';
            $correo->save();
        }
    }
}
