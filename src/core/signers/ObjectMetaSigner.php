<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\core\Ks3Request;

class ObjectMetaSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["ObjectMeta"])){
            $ObjectMeta = $args["ObjectMeta"];
            if(is_array($ObjectMeta)){
                foreach ($ObjectMeta as $key => $value) {
                    if(in_array($key,Consts::$ObjectMeta)&&!empty($value)){
                        $request->addHeader($key,$value);
                    }
                }
            }
        }
    }
}