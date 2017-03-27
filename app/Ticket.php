<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class Ticket extends ApiModel 
{
    //
    function getTickets($params = array()){
        $res = $this->call("GET", env('API_URL')."/tickets",$params);
        return $res->getBody(); 
    }

    function getTicket($id){
         $res = $this->callByAuth("GET", env('API_URL', false)."/tickets/".$id);
         if($res->getStatusCode() != 200){
             return false;
         }
         return $res->getBody()->ticket; 
    }

    function registerTicket($data) {
        $res = $this->callByAuth('POST', env('API_URL').'/tickets', $data, true);
        return $res->getBody();
    }

    function getAdminTicket($id){
         $res = $this->callByAuth("GET", env('API_URL', false)."/tickets/".$id.'/edit');
         if($res->getStatusCode() != 200){
             return false;
         }
         return $res->getBody()->ticket; 
    }

    function updateTicket($data, $id) {
        $res = $this->callByAuth('PUT', env('API_URL').'/tickets/'.$id.'/edit', $data, true);
        return $res->getBody();
    }

    function deleteTicket($data, $id) {
        $res = $this->callByAuth('DELETE', env('API_URL').'/tickets/'.$id, $data, true);
        return $res->getBody();
    }

    function purchaseTicket($data,$user_id) {
        $res = $this->callByAuth("POST", env('API_URL')."/users/".$user_id."/tickets/purchase",$data );
        if($res->getStatusCode() != 200){
            \Session::flash('api_error', $res->getBody());
             return false;
         }
        return $res->getBody(); 
    }

    function validateReceiveTicket($data, $user_id) {
        $res = $this->callByAuth("POST",env('API_URL')."/users/".$user_id."/tickets/receive",$data);
        return $res->getBody();
    }

    function receiveTicket($data, $user_id) {
        $res = $this->callByAuth("POST",env('API_URL')."/users/".$user_id."/tickets/receive",$data );
        return $res->getBody();
    }

}
