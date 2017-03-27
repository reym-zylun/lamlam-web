<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Ticket;
use App\Passcode;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PasscodeController extends Controller
{

    public function __construct(Ticket $ticket, Passcode $passcode) {
        $this->ticket   = $ticket;
        $this->passcode = $passcode;
    }

    public function getIndex(Request $request) {
        $passcodes      = array();
        $tickets        = array();
        $pagination     = array();
        $params         = array();

        $prev_select    = null;
        $prev_from_date = null;
        $prev_to_date   = null;

        if($request->has('page')) {
            $params['page'] = $request->input('page');
        }
        $tickets_tmp = $this->ticket->getTickets($params);
        $tickets_tmp = $tickets_tmp->tickets;

        foreach($tickets_tmp as $key => $ticket){
            $tickets[$key]['id']   = $ticket->id;
            $tickets[$key]['text'] = $ticket->name;
        }

        $_passcodes = $this->passcode->getIssuedTicket($request->all());
        $passcodes  = $_passcodes->issued_tickets;
        $pagination = $_passcodes->pagination;
        $counters   = $_passcodes->counters;
            
        if($request->has('ticket_id')) {
            $prev_select = $request->input('ticket_id');
        }
        if($request->has('from_date')) {
            $prev_from_date = $request->input('from_date');
        }
        if($request->has('to_date')) {
            $prev_to_date = $request->input('to_date');
        }

        return view('admin.passcode.index', [
            'passcodes'      => $passcodes,
            'pagination'     => $pagination,
            'tickets'        => json_encode($tickets), 
            'prev_select'    => $prev_select,
            'prev_from_date' => $prev_from_date,
            'prev_to_date'   => $prev_to_date,
            'counters'       => $counters
        ]);
    }

    public function getDelete(Request $request, $id) {
        $passcode = $this->passcode->deleteIssuedTicket($id);
        return response()->json($passcode, 200);
    }

    public function postCreate(Request $request) {
        $passcode = $this->passcode->createIssuedTicket($request->all(), $request->input('ticket_id'));
        return response()->json($passcode, 200);
    }

}
