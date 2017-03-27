<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Payment;
use Session;

class TicketController extends Controller
{

    /** 
     * @var Item
     */
    protected $ticket;

    /** 
     * @param Ticket $user
     */
    public function __construct(Ticket $ticket)
    {   
        $this->ticket = $ticket;
    }

    //
    public function getIndex()
    {
        $params['purchasable'] = "1";
        $tickets_tmp = $this->ticket->getTickets($params);
        $tickets_tmp = $tickets_tmp->tickets;
        $tickets = (object)array();
        foreach($tickets_tmp as $ticket){
            $tickets->{$ticket->type}[] = $ticket;
        }
        return view('tickets.index')->with(compact('tickets'));
    }

    public function purchase(Request $request, $id)
    {   
        $ticket = $this->ticket->getTicket($id);
        if ($ticket == false || 
            (is_null($ticket->adult_price) && is_null($ticket->child_price))){
            return view('errors.404');
        }

        if($request->input('child_num') == null) {
            $request->request->add(['child_num' => 0]);
        }
        if($request->input('adult_num') == null) {
            $request->request->add(['adult_num' => 0]);
        }

        $input = (object) ['adult_num' => 0, 'child_num' => 0, 'total_price' => 0]; 
        $response = (object) []; 
        if($request->isMethod('post') && $request->input('_type') == "Validate") {
            $request->request->add(['total_num' => $request->adult_num + $request->child_num]);
            $input = (object)$request->all();
            $validator = \Validator::make((array)$input, [
                'adult_num' => 'required|numeric',
                'child_num' => 'required|numeric',
                'total_num' => 'numeric|min:1'
            ]);
            if(!$validator->fails()) {
                $input->total_price = 
                    $input->adult_num * $ticket->adult_price +
                    $input->child_num * $ticket->child_price;
                return view('tickets.purchase-confirm')->with(compact('ticket', 'input'));
            }
            $response->errors = $validator->errors()->all();
        } elseif ($request->isMethod('post') && $request->input('_type') == 'Buy'){
            $input = (object)$request->all();
            $input->ticket_id = $ticket->id;
            if(Session::has('user')){
                $response = Payment::getToken(Session::get('user')->id, (array)$input);
                if(!empty($response->token)){
                    return redirect('payments/'.$response->token);
                }
            }
            return redirect('/auth/login');

        } elseif ($request->isMethod('post') && $request->input('_type') == 'Back'){
            $input = (object)$request->all();
        }
        $input->total_price = 
            $input->adult_num * $ticket->adult_price +
            $input->child_num * $ticket->child_price;

        return view('tickets.purchase-input')->with(compact('ticket', 'input', 'response'));
    }
}
