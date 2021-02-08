<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
    protected $table = 'bodegas';
    protected $fillable = [
        'nombre',
        'prefijo_facturacion',
        'alias',
        'ubicacion_id'
    ];

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class,'ubicacion_id');
    }
}
