<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;

class DefaultContentTypeSigner implements Signer
{
    public function sign(Ks3Request $request,$args=array()){
        $contentType = $request->getHeader(Headers::$ContentType);
        if(empty($contentType)){
            $request->addHeader(Headers::$ContentType,"application/xml");
        }
    }
}