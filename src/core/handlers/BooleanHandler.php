<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class BooleanHandler implements Handler{
    public function handle(ResponseCore $response){
        if($response->isOk()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}