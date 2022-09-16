<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class GetBucketLoggingHandler implements Handler{
    public function handle(ResponseCore $response){
        $logging = array();
        $xml = new \SimpleXMLElement($response->body);
        $loggingXml = $xml->LoggingEnabled;
        if($loggingXml&&$loggingXml!==NULL)
        {
            foreach ($loggingXml->children() as $key => $value) {
                $logging["Enable"] = TRUE;
                $logging[$key] = $value->__toString();
            }
        }else{
            $logging["Enable"] = FALSE;
        }
        return $logging;
    }
}