<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\core\Utils;

class SSECSigner{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["SSEC"])){
            if(isset($args["SSEC"]["Algm"]))
                $algm = $args["SSEC"]["Algm"];
            if(isset($args["SSEC"]["Key"]))
                $key = $args["SSEC"]["Key"];
            if(isset($args["SSEC"]["KeyBase64"]))
                $keybase64 = $args["SSEC"]["KeyBase64"];
            if(isset($args["SSEC"]["KeyMD5"]))
                $md5 = $args["SSEC"]["KeyMD5"];
            if(!empty($key)||!empty($keybase64)){
                if(empty($key))
                    $key = base64_decode($keybase64);
                if(empty($algm))
                    $algm = Consts::$SSEDefaultAlgm;
                if(empty($md5))
                    $md5 = Utils::hex_to_base64(md5($key));

                $request->addHeader(Headers::$SSECAlgm,$algm);
                $request->addHeader(Headers::$SSECKey,base64_encode($key));
                $request->addHeader(Headers::$SSECMD5,$md5);
            }
        }
    }
}