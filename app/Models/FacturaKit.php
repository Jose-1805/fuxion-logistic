<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaKit extends Model
{
    protected $table = 'facturas_kits';


    protected $fillable = [
        'numero',
        'empresario_id',
    ];

    public function empresario(){
        return $this->belongsTo(Empresario::class,'empresario_id');
    }

}
