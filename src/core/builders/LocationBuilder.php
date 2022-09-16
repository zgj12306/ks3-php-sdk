<?php
namespace Ks3phpsdk\core\builders;

class LocationBuilder{
    function build($args){
        if(isset($args["Location"])){
            $location = $args["Location"];
            $xml = new \SimpleXmlElement('<CreateBucketConfiguration xmlns="http://s3.amazonaws.com/doc/2006-03-01/"></CreateBucketConfiguration>');
            $xml->addChild("LocationConstraint",$args["Location"]);
            return $xml->asXml();
        }
    }
}