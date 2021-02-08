<?php
/**
 * Created by PhpStorm.
 * User: Desarrollador 1
 * Date: 1/11/2017
 * Time: 9:20 PM
 */

namespace FuxionLogistic\Http\Soap;


class Xml
{
    public static function array_to_xml($array, &$xml_user_info) {
        foreach($array as $key => $value) {
            if(is_array($value)) {
                if(!is_numeric($key)){
                    $subnode = $xml_user_info->addChild("$key");
                    Xml::array_to_xml($value, $subnode);
                }else{
                    $subnode = $xml_user_info->addChild("item$key");
                    Xml::array_to_xml($value, $subnode);
                }
            }else {
                $xml_user_info->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}