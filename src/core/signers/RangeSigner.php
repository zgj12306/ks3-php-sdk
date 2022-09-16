<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;

class RangeSigner{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["Range"])){
            $Range = $args["Range"];
            if(is_array($Range)){
                $start = $Range["start"];
                $end = $Range["end"];
                $range = "bytes=".$start."-".$end;
                $request->addHeader(Headers::$Range,$range);
            }else
                $request->addHeader(Headers::$Range,$Range);
        }
    }
}