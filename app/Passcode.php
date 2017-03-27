<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Passcode extends ApiModel
{
    function getIssuedTicket($data) {
        $res = $this->callByAuth("GET", env('API_URL')."/issued_tickets",$data);
        return $res->getBody(); 
    }
    
    function deleteIssuedTicket($id) {
        $res = $this->callByAuth('DELETE', env('API_URL').'/issued_tickets/'.$id);
        return $res->getBody();
    }

    function createIssuedTicket($data, $id) {
        $res = $this->callByAuth('POST', env('API_URL').'/tickets/'.$id.'/issue', $data);
        return $res->getBody();
    }
    //
}
