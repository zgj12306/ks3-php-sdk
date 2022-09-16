<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\core\Utils;
use Ks3phpsdk\exceptions\Ks3ClientException;

class CopySourceSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["CopySource"])){
            $CopySource = $args["CopySource"];
            if(is_array($CopySource)){
                if(!isset($CopySource["Bucket"]))
                    throw new Ks3ClientException("you should provide copy source bucket");
                if(!isset($CopySource["Key"]))
                    throw new Ks3ClientException("you should provide copy source key");
                $bucket = $CopySource["Bucket"];
                $key = Utils::encodeUrl($CopySource["Key"]);
                $request->addHeader(Headers::$CopySource,"/".$bucket."/".$key);
            }
        }
    }
}