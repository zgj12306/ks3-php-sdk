<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\lib\ResponseCore;

class CopyHandler implements Handler{
    public function handle(ResponseCore $response){
        $headers = array();

        foreach ($response->header as $key => $value) {
            if(isset(Consts::$SSEHandler[strtolower($key)])&&!empty($value)){
                $headers[Consts::$SSEHandler[strtolower($key)]]=$value;
            }
        }

        return $headers;
    }
}