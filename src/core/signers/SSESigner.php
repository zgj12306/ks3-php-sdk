<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;

class SSESigner{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["SSE"])){
            if(isset($args["SSE"]["Algm"]))
                $algm = $args["SSE"]["Algm"];
            if(isset($args["SSE"]["KMSId"]))
                $id = $args["SSE"]["KMSId"];
            if(!empty($algm)){
                $request->addHeader(Headers::$SSEAlgm,$algm);
                if(!empty($id))
                    $request->addHeader(Headers::$SSEKMSId,$id);
            }
        }
    }
}