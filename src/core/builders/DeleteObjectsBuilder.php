<?php


namespace Ks3phpsdk\core\builders;


class DeleteObjectsBuilder{
    function build($args){
        if(isset($args["DeleteKeys"])){
            $keys = $args["DeleteKeys"];
            $xml = new \SimpleXmlElement('<Delete></Delete>');
            if(is_array($keys)){
                foreach ($keys as $key => $value) {
                    $object = $xml->addChild("Object");
                    $object->addChild("Key",$value);
                }
            }
            return $xml->asXml();
        }
    }
}