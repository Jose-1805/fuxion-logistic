<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoGuiaOperadorLogistico extends Model
{
    protected $table = 'estados_guias_operadores_logisticos';


    protected $fillable = [
        'estado',
        'descripcion',
        'id_estado',
        'fecha',
        'novedad',
        'guia_id',
        'nombre_estado_operador_logistico_id'
    ];

    public function guia(){
        return $this->belongsToMany(Guia::class,'guia_id');
    }

    public function nombreEstadoOperadorLogistico(){
        return $this->belongsToMany(NombreEstadoOperadorLogistico::class,'nombre_estado_operador_logistico_id');
    }
}
