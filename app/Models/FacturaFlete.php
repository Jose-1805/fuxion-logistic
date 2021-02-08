<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaFlete extends Model
{
    protected $table = 'facturas_fletes';


    protected $fillable = [
        'numero',
        'pedido_id',
    ];

    public function pedido(){
        return $this->belongsTo(Pedido::class,'pedido_id');
    }

}
