<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Information extends ApiModel
{

    function getInformations($params) {
        $res = $this->call("GET", env('API_URL')."/informations",$params);
        return $res->getBody();
    }

    function registerInformation($data) {
        $res = $this->callByAuth('POST', env('API_URL').'/informations', $data, true);
        return $res->getBody();
    }

    function getInformation($id) {
        $res = $this->callByAuth('GET', env('API_URL').'/informations/'.$id);
        if($res->getStatusCode() != 200) {
            return false;
        }
        return $res->getBody();
    }

    function updateInformation($data, $id) {
        $res = $this->callByAuth('PUT', env('API_URL').'/informations/'.$id, $data, true);
        return $res->getBody();
    }

    function deleteInformation($data, $id) {
        $res = $this->callByAuth('DELETE', env('API_URL').'/informations/'.$id, $data, true);
        return $res->getBody();
    }

}