<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class NombreEstadoOperadorLogistico extends Model
{
    protected $table = 'nombres_estados_operadores_logisticos';


    protected $fillable = [
        'nombre',
        'operador_logistico_id',
        'estado_operador_logistico_id'
    ];

    public function estadoOperadorLogistico(){
        return $this->belongsTo(EstadoOperadorLogistico::class,'estado_operador_logistico_id');
    }
}
