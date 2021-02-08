<?php

namespace FuxionLogistic\Mail;

use FuxionLogistic\Models\Correo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PlantillaCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $titulo = '';
    public $mensaje = '';
    public $boton = false;
    public $texto_boton = '';
    public $url_boton = '';
    public $correo = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Correo $correo)
    {
        $this->correo = $correo;
        $this->titulo = $this->correo->titulo;
        $this->mensaje = $this->correo->mensaje;
        $this->boton = $this->correo->boton=='si'?true:false;
        $this->texto_boton = $this->correo->texto_boton;
        $this->url_boton = $this->correo->url_boton;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->correo->exists){
            return $this->subject($this->correo->plantillaCorreo->asunto)
                ->markdown('mail.plantilla_correo');
        }else{
            return $this->subject($this->correo->asunto)
                ->markdown('mail.plantilla_correo');
        }
    }
}
