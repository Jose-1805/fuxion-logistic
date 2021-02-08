<?php

namespace FuxionLogistic\Models;

use FuxionLogistic\User;
use Illuminate\Database\Eloquent\Model;

class Empresario extends Model
{
    protected $table = 'empresarios';
    protected $fillable = [
        'tipo',
        'empresario_id',
        'enroler_id',
        'user_id',
    ];


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function pedidos(){
        return $this->hasMany(Pedido::class,'empresario_id');
    }

    /**
     * Valida si el empresario relacionado con el modelo tiene kit
     * de afiliación.
     */
    public function validarKit(){
        //si el kit ya se relaciono en la tabla
        $kit = false;
        if($this->kit == 'si'){
            $kit = true;
        }else{
            //se busca en la tabla de kits importados
            $kit_empresario = KitEmpresario::where('inicio','<=',$this->empresario_id)
                ->where('fin','>=',$this->empresario_id)->first();
            if($kit_empresario){
                $kit = true;
                $excepciones = $kit_empresario->excepciones;
                if($excepciones){
                    $excepciones_array = explode('_',$excepciones);
                    foreach ($excepciones_array as $e){
                        $e = intval($e);
                        //el empresario es una excepción en el rango
                        //por lo tanto no existe el kit para el empresario
                        if($this->empresario_id == $e){
                            $kit = false;
                        }
                    }
                }
            }
        }

        if($kit){
            $this->kit = 'si';
            $this->save();
        }
        return $kit;
    }

    public function validarNuevoAntiguo(){

        $existe = false;
        //se busca en la tabla de kits importados
        $kit_empresario = KitEmpresario::where('inicio','<=',$this->empresario_id)
            ->where('fin','>=',$this->empresario_id)->first();
        if($kit_empresario){
            $existe = true;
            $excepciones = $kit_empresario->excepciones;
            if($excepciones){
                $excepciones_array = explode('_',$excepciones);
                foreach ($excepciones_array as $e){
                    $e = intval($e);
                    //el empresario es una excepción en el rango
                    //por lo tanto no existe el kit para el empresario
                    if($this->empresario_id == $e){
                        $existe = false;
                    }
                }
            }
        }
        $this->nuevo = !$existe;
    }
}
