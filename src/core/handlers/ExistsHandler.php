<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class ExistsHandler implements Handler{
    public function handle(ResponseCore $response){
        $status = $response->status;
        if($status === 404){
            return FALSE;
        }else{
            return TRUE;
        }
    }
}