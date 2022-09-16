<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\lib\ResponseCore;

class InitMultipartUploadHandler implements Handler{
    public function handle(ResponseCore $response){
        $upload = array();
        $xml = new \SimpleXMLElement($response->body);
        foreach ($xml->children() as $key => $value) {
            $upload[$key] = $value->__toString();
        }

        foreach ($response->header as $key => $value) {
            if(isset(Consts::$SSEHandler[strtolower($key)])&&!empty($value)){
                $upload[Consts::$SSEHandler[strtolower($key)]]=$value;
            }
        }

        return $upload;
    }
}