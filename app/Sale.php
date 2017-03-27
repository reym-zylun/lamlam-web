<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Sale extends ApiModel
{

    function getSales($params) {
        $res = $this->callByAuth("GET", env('API_URL')."/sales_summaries",$params);
        return $res->getBody();
    }

}