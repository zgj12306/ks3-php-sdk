<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\lib\ResponseCore;

class ObjectMetaHandler implements Handler{
    public function handle(ResponseCore $response){
        $ObjectMeta = array();
        $UserMeta = array();
        foreach ($response->header as $key => $value) {
            if (substr(strtolower($key), 0, 10) === Consts::$UserMetaPrefix){
                $UserMeta[$key]=$value;
            }else if(isset(Consts::$ResponseObjectMeta[strtolower($key)])){
                $ObjectMeta[Consts::$ResponseObjectMeta[strtolower($key)]]=$value;
            }
        }
        $Meta = array(
            "ObjectMeta"=>$ObjectMeta,
            "UserMeta"=>$UserMeta
        );
        return $Meta;
    }
}