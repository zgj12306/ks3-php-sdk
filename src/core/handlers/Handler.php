<?php
namespace Ks3phpsdk\core\handlers;


use Ks3phpsdk\lib\ResponseCore;

interface Handler{
    public function handle(ResponseCore $response);
}