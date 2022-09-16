<?php
namespace Ks3phpsdk\encryption;



interface EncryptionHandler{
	public function putObjectByContentSecurely($args=array());
	public function putObjectByFileSecurely($args=array());
	public function getObjectSecurely($args=array());
	public function initMultipartUploadSecurely($args=array());
	public function uploadPartSecurely($args=array());
	public function abortMultipartUploadSecurely($args=array());
	public function completeMultipartUploadSecurely($args=array());
}

?>