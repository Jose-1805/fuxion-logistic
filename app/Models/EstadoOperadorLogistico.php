<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;

class EstadoOperadorLogistico extends Model
{
    protected $table = 'estados_operadores_logisticos';
    protected $fillable = [
        'nombre',
        'alias',
        'descripcion',
        'notificacion_push',
        'notificacion_correo',
        'correos_destinatarios',
        'plantilla_correo_id',
        'cambio_estado_pedido_id',
    ];

    public function plantillaCorreo(){
        return $this->belongsTo(PlantillaCorreo::class,'plantilla_correo_id');
    }

    public function operadoresLogisticos(){
        return $this->belongsToMany(OperadorLogistico::class,'nombres_estados_operadores_logisticos','estado_operador_logistico_id','operador_logistico_id');
    }

    public function nombreEstadoPorOperadorLogistico($id_operador_logistico){
        if($this->exists){
            $relacion = $this->operadoresLogisticos()->select('nombres_estados_operadores_logisticos.nombre')
                ->where('operadores_logisticos.id',$id_operador_logistico)->first();
            if($relacion)return $relacion->nombre;
        }
        return null;
    }
}
