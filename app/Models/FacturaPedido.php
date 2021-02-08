<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class FacturaPedido extends Model
{
    protected $table = 'facturas_pedidos';


    protected $fillable = [
        'numero',
        'pedido_id',
    ];

    public function pedido(){
        return $this->belongsTo(Pedido::class,'pedido_id');
    }

}
