<?php

namespace FuxionLogistic\Mail;

use FuxionLogistic\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionGeneral extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $notificacion;
    public $boton;
    public $texto_boton;
    public $url_boton;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$notificacion,$boton = false,$texto_boton = '', $url_boton)
    {
        $this->user = $user;
        $this->notificacion = $notificacion;
        $this->boton = $boton;
        $this->texto_boton = $texto_boton;
        $this->url_boton = $url_boton;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.notificacion_general');
    }
}
