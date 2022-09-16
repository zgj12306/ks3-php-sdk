<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;

class ContentLengthSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        $contentlength = "";
        if(isset($args["ObjectMeta"][Headers::$ContentLength])){
            $contentlength = $args["ObjectMeta"][Headers::$ContentLength];
        }
        if(empty($contentlength)){
            $body = $request->body;
            if(!empty($body)){
                $contentlength = strlen($body);
            }
        }
        if(!empty($contentlength))
            $request->addHeader(Headers::$ContentLength,$contentlength);
    }
}