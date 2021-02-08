<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;

class PlantillaCorreo extends Model
{
    protected $table = 'plantillas_correos';
    protected $fillable = [
        'nombre',
        'asunto',
    ];
}
