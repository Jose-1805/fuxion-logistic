<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class MallaCobertura extends Model
{
    protected $table = "mallas_cobertura";

    protected $fillable = [
        'origen',
        'destino',
        'tiempo_entrega',
        'operador_logistico_id',
    ];

    public function operadorLogistico(){
        return $this->belongsTo(OperadorLogistico::class,'operador_logistico_id');
    }
}
