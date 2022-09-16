<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Ks3Request;

class AllHeaderSigner{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        $headers = isset($args["Headers"])?$args["Headers"]:"";
        if(!empty($headers)&&is_array($headers)){
            foreach ($headers as $key => $value) {
                $request->addHeader($key,$value);
            }
        }
    }
}