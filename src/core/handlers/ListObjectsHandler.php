<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class ListObjectsHandler implements Handler{
    public function handle(ResponseCore $response){
        $result = array();
        $xml = new \SimpleXMLElement($response->body);
        $result["Name"]=$xml->Name->__toString();
        $result["Prefix"]=$xml->Prefix->__toString();
        $result["Marker"]=$xml->Marker->__toString();
        $result["Delimiter"]=$xml->Delimiter->__toString();
        $result["MaxKeys"]=$xml->MaxKeys->__toString();
        $result["IsTruncated"]=$xml->IsTruncated->__toString();
        $result["NextMarker"]=$xml->NextMarker->__toString();
        $contents = array();
        foreach ($xml->Contents as $contentXml) {
            $content = array();
            foreach ($contentXml->children() as $key => $value) {
                $owner = array();
                if($key === "Owner"){
                    foreach ($value->children() as $ownerkey => $ownervalue) {
                        $owner[$ownerkey]=$ownervalue->__toString();
                    }
                    $content["Owner"] = $owner;
                }else{
                    $content[$key]=$value->__toString();
                }
            }
            array_push($contents, $content);
        }
        $result["Contents"] = $contents;

        $commonprefix = array();
        foreach ($xml->CommonPrefixes as $commonprefixXml) {
            foreach ($commonprefixXml->children() as $key => $value) {
                array_push($commonprefix, $value->__toString());
            }
        }
        $result["CommonPrefixes"] = $commonprefix;
        return $result;
    }
}