<?php

namespace App;

use Illuminate\Http\Response;
use App\ApiModel;

class UserTicket extends ApiModel 
{
    //
    function getTickets($data,$user_id){
        
         $res = $this->callByAuth("GET", env('API_URL', false)."/users/{$user_id}/tickets",$data);

         if($res->getStatusCode() != 200){
             return false;
         }

        return $res->getBody();
    }

    function getTicket($user_id, $user_ticket_id){
         
        $res = $this->callByAuth("GET", env('API_URL', false)."/users/{$user_id}/tickets/{$user_ticket_id}");
         if($res->getStatusCode() != 200){
             return false;
         }

        return $res->getBody()->user_ticket;
    }


    function getSplitTicket($user_id, $user_ticket_id){

        $res = $this->callByAuth("GET", env('API_URL', false)."/users/{$user_id}/tickets/{$user_ticket_id}/split");

        return $res->getBody();
    }

    function postUse($user_id, $user_ticket_id){

        $res = $this->callByAuth("POST", env('API_URL', false)."/users/{$user_id}/tickets/{$user_ticket_id}/use", [], true);

        return $res->getBody();
    }

    function postSplit($request, $user_id, $user_ticket_id){

        $res = $this->callByAuth("POST", env('API_URL', false)."/users/{$user_id}/tickets/{$user_ticket_id}/split", $request->all(), true);

        return $res->getBody();
    }
    function CancelTicket($request,$user_id,$user_ticket_id)
    {
        $ApiModel = new ApiModel();
        $res = $ApiModel->callByAuth("POST", env('API_URL')."/users/{$user_id}/tickets/{$user_ticket_id}/cancel",  $request);
        return $res->getBody();
    }


}
