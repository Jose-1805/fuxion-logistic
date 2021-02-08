<?php
/**
 * Created by PhpStorm.
 * User: Desarrollador 1
 * Date: 9/10/2017
 * Time: 2:31 PM
 */

namespace FuxionLogistic\Http\Soap;


class PruebaMultiplicacion
{
    protected $intA;
    protected $intB;

    public function __construct($intA,$intB)
    {
        $this->intA = $intA;
        $this->intB = $intB;
    }

    public function getIntA(){
        return $this->intA;
    }

    public function getIntB(){
        return $this->intB;
    }
}