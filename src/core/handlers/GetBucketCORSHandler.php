<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class GetBucketCORSHandler implements Handler{
    public function handle(ResponseCore $response){
        $xml = new \SimpleXMLElement($response->body);
        $cors = array();
        foreach ($xml->CORSRule as $rule) {
            $acors = array();
            foreach ($rule as $key => $value) {
                if($key === "MaxAgeSeconds")
                {
                    $acors[$key] = $value->__toString();
                }else{
                    if(!isset($acors[$key])){
                        $acors[$key] = array();
                    }
                    array_push($acors[$key],$value->__toString());
                }
            }
            array_push($cors,$acors);
        }
        return $cors;
    }
}