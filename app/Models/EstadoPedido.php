<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;

class EstadoPedido extends Model
{
    protected $table = 'estados_pedidos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'notificacion_push',
        'notificacion_correo',
        'correos_destinatarios',
        'defecto_no_kit',
        'defecto_no_corte',
        'plantilla_correo_id',
    ];

    public function plantillaCorreo(){
        return $this->belongsTo(PlantillaCorreo::class,'plantilla_correo_id');
    }
}
