<?php

namespace FuxionLogistic\Models;


class TareasSistema
{
    public static function setMasivo($tabla,$campo,$valor,$ids = []){
        $sql = 'UPDATE '.$tabla.' set '.$campo.' = "'.$valor.'" WHERE id IN ('.implode(',',$ids).')';
    }

    /**
     * Evalua si uno de los modulos recibidos como parametro equivale a URI actual y retorna
     * el valor item-selected para marcar el item del menu como seleccionado
     *
     * @param $data
     */
    public static function claseEnMenu($modulos){
        $modulo_uri = explode('/',trim($_SERVER['REQUEST_URI'],'/'))[0];
        foreach ($modulos as $modulo) {
            if ($modulo_uri == $modulo)
                return 'item-selected';
        }
        return '';
    }

    public static function styleSubMenu($modulos){
        $modulo_uri = explode('/',trim($_SERVER['REQUEST_URI'],'/'))[0];
        foreach ($modulos as $modulo) {
            if ($modulo_uri == $modulo)
                return '';
        }
        return 'display:none;';
    }

}
