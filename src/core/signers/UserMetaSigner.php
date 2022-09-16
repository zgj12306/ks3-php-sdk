<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\core\Ks3Request;

class UserMetaSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["UserMeta"])){
            $UserMeta = $args["UserMeta"];
            if(is_array($UserMeta)){
                foreach ($UserMeta as $key => $value) {
                    if (substr(strtolower($key), 0, 10) === Consts::$UserMetaPrefix){
                        $request->addHeader($key,$value);
                    }
                }
            }
        }
    }
}