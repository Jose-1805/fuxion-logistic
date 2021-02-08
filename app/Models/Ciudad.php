<?php

namespace FuxionLogistic\Models;

use function foo\func;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = "ciudades";
    public $timestamps = false;

    protected $fillable = [
    ];

    public function departamento(){
        return $this->belongsTo(Departamento::class,'departamento_id');
    }

    public function operadoresLogisticos(){
        return $this->belongsToMany(OperadorLogistico::class,'operadores_logisticos_ciudades','ciudad_id','operador_logistico_id');
    }

    public function nombreParaOL($ol_id){
        $data = $this->operadoresLogisticos()->select('operadores_logisticos_ciudades.nombre')
            ->where('operadores_logisticos.id',$ol_id)->first();
        if($data)return $data->nombre;
        return '';
    }

    public static function porNombre($nombre){
        $ciudad = Ciudad::select('ciudades.*')
            ->join('operadores_logisticos_ciudades','ciudades.id','=','operadores_logisticos_ciudades.ciudad_id')
            ->where(function($q) use ($nombre){
                $q->where('ciudades.nombre',$nombre)
                    ->orWhere('operadores_logisticos_ciudades.nombre',$nombre);
            })->first();
        return $ciudad;
    }
}