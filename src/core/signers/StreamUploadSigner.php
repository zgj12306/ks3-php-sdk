<?php


namespace Ks3phpsdk\core\signers;

use Ks3phpsdk\core\Headers;
use Ks3phpsdk\core\Ks3Request;
use Ks3phpsdk\core\Utils;
use Ks3phpsdk\exceptions\Ks3ClientException;

class StreamUploadSigner implements Signer{
    public function sign(Ks3Request $request,$args=array()){
        $args = $args["args"];
        if(isset($args["Content"])&&is_array($args["Content"])&&isset($args["Content"]["content"])){
            $content = $args["Content"]["content"];
            $seek_position = 0;
            $resourceLength = 0;
            $length = -1;
            $isFile = FALSE;

            if (!is_resource($content)){
                $isFile = TRUE;
                //如果之前用户已经转化为GBK则不转换
                if(Utils::chk_chinese($content)&&!Utils::check_char($content)){
                    $content = iconv('utf-8','gbk',$content);
                }
                if(!file_exists($content))
                    throw new Ks3ClientException("the specified file does not exist ");
                $length = Utils::getFileSize($content);
                $content = fopen($content,"r");
            }else{
                $stats = fstat($content);
                if ($stats && $stats["size"] >= 0){
                    $length = $stats["size"];
                }
            }
            //之所以取resourceLength是为了防止Content-Length大于实际数据的大小，导致一直等待。
            $resourceLength = $length;
            //优先取用户设置seek_position，没有的话取ftell
            if(isset($args["Content"]["seek_position"])&&$args["Content"]["seek_position"]>0){
                $seek_position = $args["Content"]["seek_position"];
            }else if(!$isFile){
                $seek_position = ftell($content);
                if($seek_position<0)
                    $seek_position = 0;
                fseek($content,0);
            }

            $lengthInMeta = -1;
            if(isset($args["ObjectMeta"]["Content-Length"])){
                $lengthInMeta = $args["ObjectMeta"]["Content-Length"];
            }
            if($lengthInMeta > 0){
                $length = $lengthInMeta;
            }else if($resourceLength > 0){
                //根据seek_position计算实际长度
                $length = $resourceLength - $seek_position;
            }
            if($length <= 0)
                throw new Ks3ClientException("calculate content length failed,unexpected contetn length ".$length);
            $request->read_stream = $content;
            $request->addHeader(Headers::$ContentLength,$length);
            $request->seek_position = $seek_position;
        }else{
            throw new Ks3ClientException("please specifie upload content in args");
        }
    }
}