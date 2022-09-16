<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\lib\ResponseCore;

class UploadHandler implements Handler{
    public function handle(ResponseCore $response){
        $Headers = array();
        foreach ($response->header as $key => $value) {
            if(isset(Consts::$UploadHandler[strtolower($key)])&&!empty($value)){
                $Headers[Consts::$UploadHandler[strtolower($key)]]=$value;
            }
        }
        return $Headers;
    }
}