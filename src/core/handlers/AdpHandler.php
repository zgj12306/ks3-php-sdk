<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class AdpHandler implements Handler{
    public function handle(ResponseCore $response){
        return $response->body;
    }
}