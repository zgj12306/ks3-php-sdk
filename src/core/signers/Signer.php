<?php
namespace Ks3phpsdk\core\signers;


use Ks3phpsdk\core\Ks3Request;

interface Signer
{
    public function sign( Ks3Request $request,$args=array());
}