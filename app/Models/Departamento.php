<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = "departamentos";
    public $timestamps = false;

    protected $fillable = [
    ];

    public function ciudades(){
        return $this->hasMany(Ciudad::class,'departamento_id');
    }

    public function pais(){
        return $this->belongsTo(Pais::class,'pais_id');
    }

    public function operadoresLogisticos(){
        return $this->belongsToMany(OperadorLogistico::class,'operadores_logisticos_departamentos','departamento_id','operador_logistico_id');
    }

    public function nombreParaOL($ol_id){
        $data = $this->operadoresLogisticos()->select('operadores_logisticos_departamentos.nombre')
            ->where('operadores_logisticos.id',$ol_id)->first();
        if($data)return $data->nombre;
        return '';
    }

    public static function porNombre($nombre){
        $departamento = Departamento::select('departamentos.*')
            ->join('operadores_logisticos_departamentos','departamentos.id','=','operadores_logisticos_departamentos.departamento_id')
            ->where(function($q) use ($nombre){
                $q->where('departamentos.nombre',$nombre)
                    ->orWhere('operadores_logisticos_departamentos.nombre',$nombre);
            })->first();
        return $departamento;
    }
}