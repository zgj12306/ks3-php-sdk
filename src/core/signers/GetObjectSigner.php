<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\core\Utils;

class GetObjectSigner{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["WriteTo"])){
            $WriteTo = $args["WriteTo"];
            if(is_resource($WriteTo)){
                $request->write_stream = $WriteTo;
            }else{
                //如果之前用户已经转化为GBK则不转换
                if(Utils::chk_chinese($WriteTo)&&!Utils::check_char($WriteTo)){
                    $WriteTo = iconv('utf-8','gbk',$WriteTo);
                }
                $request->write_stream = fopen($WriteTo,"w");
            }
        }
    }
}