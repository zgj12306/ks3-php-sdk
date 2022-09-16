<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class ListBucketsHandler implements Handler{

    public function handle(ResponseCore $response){
        $result = array();
        $xml = new SimpleXMLElement($response->body);
        foreach ($xml->Buckets->Bucket as $bucketXml) {
            $bucket = array();
            foreach ($bucketXml->children() as $key => $value) {
                $bucket[$key]=$value->__toString();
            }
            array_push($result, $bucket);
        }
        return $result;
    }
}