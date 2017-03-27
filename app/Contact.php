<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Contact extends ApiModel 
{
    /**
     * Validate inputed Fields
     * @param $request
     * @desc Validate New Contact Input
     */
    public function ValidateContact($request)
    {
        $ApiModel = new ApiModel();
        $res = $ApiModel->call("POST", env('API_URL')."/contact",  $request);
        return $res->getBody();
    }
    
    /**
     * Register a User
     * @param $request
     * @desc Create New User
     */
    public function ProcessContact($request)
    {
        $ApiModel = new ApiModel();
        $res = $ApiModel->call("POST", env('API_URL')."/contact",  $request);
        return $res->getBody();
    }
}
