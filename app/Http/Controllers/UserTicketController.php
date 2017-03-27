<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use App\Ticket;
use App\UserTicket;
use App\Payment;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Input;

class UserTicketController extends Controller
{
   /**
   * @var Item
   */
   protected $userticket;
    
   /**
   * @param UserTicket $userticket
   */
   public function __construct(UserTicket $userticket, Ticket $ticket)
   {
        $this->ticket = $ticket;
        $this->userticket = $userticket;
   }

   public function getIndex($user_id)
   {
        $usertickets = array();
        $usertickets = $this->userticket->getTickets(null,$user_id);
        return view('users.tickets.index')->with(compact('usertickets','user_id'));
   }

   public function getShow($user_id, $user_ticket_id)
   {
        $userticket = array();
        $date_now   = \Carbon\Carbon::now();
        $userticket = $this->userticket->getTicket($user_id,$user_ticket_id);
        return view('users.tickets.show')->with(compact('userticket','user_id', 'user_ticket_id','date_now'));
   }

   public function postUse(Request $request, $id, $user_ticket_id)  
   {
       $response = $this->userticket->postUse($id,$user_ticket_id);
       if($response->result == config("define.result.success")){
           return response()->json([
               'user_ticket' => $response->user_ticket
           ], 200);
       }else{
           return response()->json([
               'errors' => $response->errors
           ], 422);
       }
   }
   
   public function postSplit(Request $request, $id, $user_ticket_id)  
   {
       $response = $this->userticket->postSplit($request, $id,$user_ticket_id);
       if($response->result == config("define.result.success")){
           return response()->json([
               'receive_key' => $response->split_ticket->receive_key
           ], 200);
       }
       return response()->json([
           'errors' => $response->errors
       ], 422);
   }

    public function getReceive($user_id)
    {
        return view('users.tickets.receive-input')->with(compact('user_id')); 
    }

   public function postReceive(Request $request, $user_id)
   {
        $response = new \stdClass(); 
        $input = []; 
         
        if(strtoupper($request->input('_registtype')) == "VALIDATE") {
            $input = $request->all(); 
            $response = $this->ticket->validateReceiveTicket($input, $user_id);
            if($response->result == config('define.result.success')) {
                $receive_ticket = $response->receive_ticket;
                return view('users.tickets.receive-confirm')->with(compact('user_id','receive_ticket')); 
            }
        }else if(strtoupper($request->input('_registtype')) == "REGIST") {
            $input = $request->all(); 
            $response = $this->ticket->receiveTicket($input, $user_id);
            if($response->result == config('define.result.success')) {
                return view('users.tickets.receive-complete')->with(compact('user_id'));
            }
        } else if(strtoupper($request->input('_registtype')) == 'BACK'){
            $input = $request->all(); 
        }

        $input = (object)$input;
        return view('users.tickets.receive-input')->with(compact('user_id','response','input')); 
   }

    public function postPaymentStart(Request $request, $id)  
    {
        $token = Payment::getToken($id, $request->all());
        if(!$token){
            return redirect('tickets/'.$request->input('ticket_id'));
        }
        return redirect('payments/'.$token);
    }

    public function getCancelTickets($user_id) {
        $request = array();
        $request['cancelable'] = true;
        $usertickets = $this->userticket->getTickets($request,$user_id);
        return view('users.tickets.cancel-select')->with(compact('usertickets','user_id'));
    }

    public function cancel(Request $request,$user_id,$user_ticket_id) {
        $userticket = $this->userticket->getTicket($user_id,$user_ticket_id);

        if($request->isMethod('get')) {
          if($userticket == false) {
            return view('errors.404');
          }
            return view('users.tickets.cancel-input')->with(compact('userticket','user_id'));
        } else if($request->isMethod('post')) {
            $_contype = $request->input('_contype');
            $con = $request->all();

            if (strtolower($_contype) == strtolower('Validate')){
              $response = $this->userticket->CancelTicket($request->all(),$user_id,$user_ticket_id);
              $con = (object)$con;

              if(isset($response->result) && $response->result == config('define.result.success')) {
                return view('users.tickets.cancel-confirm')->with(compact('userticket','user_id','response','con'));
              }
            }
            else if (strtolower($_contype) == strtolower('Save')){
              $response = $this->userticket->CancelTicket($request->all(),$user_id,$user_ticket_id);
              if($response->result == config('define.result.success')){
                  return view('users.tickets.cancel-complete')->with(compact('response','user_id'));
              }
            } 
            else if (strtolower($_contype) == strtolower('Back')){
              $con = $request->all();
            }
            $con = (object)$con;
            return view('users.tickets.cancel-input')->with(compact('userticket','user_id','response','con'));
        }
    }

}
