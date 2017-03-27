<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Ticket;
use App\Sale;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SaleController extends Controller
{

    public function __construct(Ticket $ticket, Sale $sale) {
        $this->ticket = $ticket;
        $this->sale   = $sale;
    }

    public function getIndex(Request $request) {
        $sales      = array();
        $tickets        = array();
        $prev_select    = null;
        $prev_from_date = null;
        $prev_to_date   = null;
        $params['purchasable'] = "1";
        $tickets_tmp = $this->ticket->getTickets($params);
        $tickets_tmp = $tickets_tmp->tickets;

        foreach($tickets_tmp as $key => $ticket){
            $tickets[$key]['id']   = $ticket->id;
            $tickets[$key]['text'] = $ticket->name;
        }

        if($request->isMethod('post')) {
            $_sales = $this->sale->getSales($request->all());
            $sales  = $_sales->sales_summaries;
        }

        if($request->has('ticket_id')) {
            $prev_select = $request->input('ticket_id');
        }
        if($request->has('from_date')) {
            $prev_from_date = $request->input('from_date');
        }
        if($request->has('to_date')) {
            $prev_to_date = $request->input('to_date');
        }

        return view('admin.sales.index', [
            'sales'          =>$sales, 
            'tickets'        =>json_encode($tickets), 
            'prev_select'    =>$prev_select,
            'prev_from_date' => $prev_from_date,
            'prev_to_date'   => $prev_to_date
        ]);
    } 
    //
}
