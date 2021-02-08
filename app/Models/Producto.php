<?php

namespace FuxionLogistic\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $fillable = [
        'codigo',
        'descripcion'
    ];

    public function pedidos(){
        return $this->belongsToMany(Pedido::class,'pedidos_productos','producto_id','pedido_id');
    }
}
