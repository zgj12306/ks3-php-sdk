<?php
namespace Ks3phpsdk\core\signers;


use Ks3phpsdk\config\Consts;
use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;

class DefaultUserAgentSigner implements Signer
{
    public function sign(Ks3Request $request,$args=array()){
        $request->addHeader(Headers::$UserAgent,Consts::$UserAgent);
    }
}