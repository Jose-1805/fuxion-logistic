<?php
/**
 * Created by PhpStorm.
 * User: Desarrollador 1
 * Date: 1/11/2017
 * Time: 8:18 PM
 */

namespace FuxionLogistic\Http\Soap;


class CargueMasivoServientrega
{
    protected $cargue_masivo_externo;

    public function __construct($cargue_masivo_externo)
    {
        $this->cargue_masivo_externo = $cargue_masivo_externo;
    }

    public function getCargueMasivoExterno(){
        return $this->cargue_masivo_externo;
    }
}