<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Ad extends ApiModel 
{
    function getAd($id){
         $res = $this->call("GET", env('API_URL', false)."/ads/".$id);
         if($res->getStatusCode() != 200){
             return false;
         }
         return $res->getBody()->ad; 
    }
}
