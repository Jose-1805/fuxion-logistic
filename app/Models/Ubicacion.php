<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $table = "ubicaciones";
    public $timestamps = false;

    protected $fillable = [
        'carrera',
        'calle',
        'numero',
        'barrio',
        'especificaciones',
    ];

    public function ciudad(){
        return $this->belongsTo(Ciudad::class,'ciudad_id');
    }

    public function stringDireccion(){
        $direccion = "";
        $calle = false;
        if($this->calle) {
            $direccion = "Calle " . $this->calle;
            $calle = true;
        }

        if($this->carrera){
            if($calle)$direccion .= ' con carrera '.$this->carrera;
            else $direccion = "Carrera ".$this->carrera;
        }

        $direccion .= " # ".$this->numero." (".$this->barrio.")";
        return $direccion;
    }
}