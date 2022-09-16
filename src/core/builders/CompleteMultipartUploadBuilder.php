<?php


namespace Ks3phpsdk\core\builders;

use Ks3phpsdk\config\Consts;

class CompleteMultipartUploadBuilder{
    function build($args){
        if(isset($args["Parts"])){
            $parts = $args["Parts"];
            $xml = new \SimpleXmlElement('<CompleteMultipartUpload></CompleteMultipartUpload>');
            if(is_array($parts)){
                foreach ($parts as $part) {
                    $partXml = $xml->addChild("Part");
                    foreach ($part as $key => $value) {
                        if(in_array($key,Consts::$PartsElement)){
                            $partXml->addChild($key,$value);
                        }
                    }
                }
            }
            return $xml->asXml();
        }
    }
}