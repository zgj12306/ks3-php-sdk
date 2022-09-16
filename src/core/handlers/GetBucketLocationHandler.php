<?php


namespace Ks3phpsdk\core\handlers;


use Ks3phpsdk\lib\ResponseCore;

class GetBucketLocationHandler implements Handler{
    public function handle(ResponseCore $response){
        $xml = new \SimpleXMLElement($response->body);
        $location = $xml->__toString();

        return $location;
    }
}