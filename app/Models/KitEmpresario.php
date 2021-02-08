<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;

class KitEmpresario extends Model
{
    protected $table = 'kit_empresarios';
    protected $fillable = [
        'inicio',
        'fin',
        'excepciones',
    ];
}
