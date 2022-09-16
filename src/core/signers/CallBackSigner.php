<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\config\Consts;
use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\exceptions\Ks3ClientException;

class CallBackSigner{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["CallBack"])&&is_array($args["CallBack"])){
            $CallBackConf = $args["CallBack"];
            $url = NULL;
            $body = NULL;
            if(isset($CallBackConf["Url"])){
                $url = $CallBackConf["Url"];
            }
            if(empty($url))
                throw new Ks3ClientException("Url is needed in CallBack");
            if(isset($CallBackConf["BodyMagicVariables"])){
                if(is_array($CallBackConf["BodyMagicVariables"])){
                    $magics = $CallBackConf["BodyMagicVariables"];
                    foreach ($magics as $key => $value) {
                        if(in_array($value,Consts::$CallBackMagics))
                            $body.=$key."=\${".$value."}&";
                    }
                }
            }
            if(isset($CallBackConf["BodyVariables"])){
                if(is_array($CallBackConf["BodyVariables"])){
                    $variables = $CallBackConf["BodyVariables"];
                    foreach ($variables as $key => $value) {
                        $body.=$key."=\${kss-".$key."}&";
                        $request->addHeader("kss-".$key,$value);
                    }
                }
            }
            if(!empty($body)){
                $body=substr($body,0,strlen($body)-1);
                $request->addHeader(Headers::$XKssCallbackBody,$body);
            }
            $request->addHeader(Headers::$XKssCallbackUrl,$url);
        }
    }
}