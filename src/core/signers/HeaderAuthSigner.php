<?php


namespace Ks3phpsdk\core\signers;


use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\exceptions\Ks3ClientException;

class HeaderAuthSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $log = "stringToSing->\r\n";
        $date = gmdate('D, d M Y H:i:s \G\M\T');
        $request->addHeader(Headers::$Date, $date);

        $ak = $args["accessKey"];
        $sk = $args["secretKey"];
        if(empty($ak)){
            throw new Ks3ClientException("you should provide accessKey");
        }
        if(empty($sk)){
            throw new Ks3ClientException("you should provide secretKey");
        }
        $authration = "KSS ";
        $signList = array(
            $request->method,
            $request->getHeader(Headers::$ContentMd5),
            $request->getHeader(Headers::$ContentType),
            $date
        );
        $headers = AuthUtils::canonicalizedKssHeaders($request);
        $resource = AuthUtils::canonicalizedResource($request);
        if(!empty($headers)){
            array_push($signList,$headers);
        }
        array_push($signList,$resource);
        $stringToSign = join("\n",$signList);
        $log.= $stringToSign;
        $signature = base64_encode(hash_hmac('sha1', $stringToSign, $sk, true));

        $authration.=$ak.":".$signature;
        $request->addHeader(Headers::$Authorization, $authration);
        return $log;
    }
}