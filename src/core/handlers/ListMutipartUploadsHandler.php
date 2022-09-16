<?php


namespace Ks3phpsdk\core\handlers;

use Ks3phpsdk\lib\ResponseCore;

class ListMutipartUploadsHandler implements Handler{
    public function handle(ResponseCore $response){
        $mutiUploads = array();
        $xml = new SimpleXMLElement($response->body);

        $mutiUploads["Bucket"]=$xml->Bucket->__toString();
        $mutiUploads["KeyMarker"]=$xml->KeyMarker->__toString();
        $mutiUploads["UploadIdMarker"]=$xml->UploadIdMarker->__toString();
        $mutiUploads["NextKeyMarker"]=$xml->NextKeyMarker->__toString();
        $mutiUploads["NextUploadIdMarker"]=$xml->NextUploadIdMarker->__toString();
        $mutiUploads["MaxUploads"]=$xml->MaxUploads->__toString();
        $mutiUploads["IsTruncated"]=$xml->IsTruncated->__toString();


        $uploads = array();
        foreach ($xml->Upload as $uploadxml) {
            $upload = array();
            foreach ($uploadxml->children() as $key => $value) {
                if($key === "Initiator"){
                    $initer = array();
                    foreach ($value->children() as $key1 => $value1) {
                        $initer[$key1] = $value1->__toString();
                    }
                    $upload["Initiator"] = $initer;
                }elseif($key === "Owner"){
                    $owner = array();
                    foreach ($value->children() as $key1 => $value1) {
                        $owner[$key1] = $value1->__toString();
                    }
                    $upload["Owner"] = $owner;
                }else{
                    $upload[$key] = $value->__toString();
                }
            }
            array_push($uploads,$upload);
        }
        $mutiUploads["Uploads"] = $uploads;
        return $mutiUploads;
    }
}