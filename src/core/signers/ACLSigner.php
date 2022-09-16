<?php


namespace Ks3phpsdk\core\signers;


use Ks3phpsdk\config\Consts;
use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\exceptions\Ks3ClientException;

class ACLSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["ACL"])){
            $acl = $args["ACL"];
            if(!in_array($acl, Consts::$Acl)){
                throw new Ks3ClientException("unsupport acl :".$acl);
            }else{
                $request->addHeader(Headers::$Acl,$acl);
            }
        }
        if(isset($args["ACP"])){

        }
    }
}