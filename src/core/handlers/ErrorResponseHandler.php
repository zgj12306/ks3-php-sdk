<?php


namespace Ks3phpsdk\core\handlers;


use Ks3phpsdk\exceptions\Ks3ServiceException;
use Ks3phpsdk\lib\ResponseCore;

class ErrorResponseHandler implements Handler{
    public function handle(ResponseCore $response){
        $code = $response->status;
        if($code >= 400){
            $exception = new Ks3ServiceException();
            $exception->statusCode=$code;
            if(!empty($response->body)){
                $xml = new \SimpleXMLElement($response->body);
                $exception ->requestId = $xml->RequestId->__toString();
                $exception->errorCode = $xml->Code->__toString();
                $exception->errorMessage=$xml->Message->__toString();
                $exception->resource=$xml->Resource->__toString();
            }
            throw $exception;
        }else{
            return $response;
        }
    }
}