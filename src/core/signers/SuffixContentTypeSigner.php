<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\core\Utils;

class SuffixContentTypeSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $key = $request->key;
        $objArr = explode('/', $key);
        $basename = array_pop($objArr);
        $extension = explode ( '.', $basename );
        $extension = array_pop ( $extension );
        $content_type = Utils::get_mimetype(strtolower($extension));
        $request->addHeader(Headers::$ContentType,$content_type);
    }
}