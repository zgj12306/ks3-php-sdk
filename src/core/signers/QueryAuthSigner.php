<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;


class QueryAuthSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $log = "stringToSing->\r\n";
        $ak = $args["accessKey"];
        $sk = $args["secretKey"];
        $expires = $args["args"]["Options"]["Expires"];
        $expiresSencond = time()+$expires;

        $resource = AuthUtils::canonicalizedResource($request);
        $signList = array(
            $request->method,
            $request->getHeader(Headers::$ContentMd5),
            $request->getHeader(Headers::$ContentType),
            $expiresSencond
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
        $request->addQueryParams("KSSAccessKeyId",$ak);
        $request->addQueryParams("Signature",$signature);
        $request->addQueryParams("Expires",$expiresSencond);
        return $log;
    }
}