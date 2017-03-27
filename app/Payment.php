<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Payment extends ApiModel
{
    static function getToken($user_id, $params)
    {
        $res = self::callByAuth(
            'POST',
            env('API_URL')."/users/{$user_id}/paymenttoken",$params
        );
        return $res->getBody();
    }

    public function getPayment($token)
    {
        $res = $this->call("GET", env('API_URL')."/payments/". $token);
        if($res->getStatusCode() != 200){
            return false;
        }
        return $res->getBody()->payment;
    }

    public function charge($token, $request) {

        $res = $this->call("POST", env('API_URL')."/payments/".$token, $request->all());
        return $res->getBody();

    }

    public function getResult($token)
    {
        $res = $this->call("GET", env('API_URL')."/payments/". $token. "/result");
        return $res->getBody()->result;
    }

}
