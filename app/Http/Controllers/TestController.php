<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Test;
use App\Ticket;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
	public function __construct(Test $test, Ticket $ticket)
    {
        $this->test = $test;
        $this->ticket = $ticket;
    }
    public function getResponse() {
    	return view('test.response',['res'=>json_encode(Session::get('res')) ]);
    }
    public function postResponse(Request $request) {
        $refresh_token  = array('refresh_token'=>Session::get('refresh_token'));
        $test_route     = $request->input('selectsearch');
        $param1         = $request->input('param1');

        if($test_route == 1) {
            $data = $this->test->reIssueToken($refresh_token);
            return redirect()
            ->to('/test-response')->with('res',$data);
        } else if($test_route == 2) {
            $data = $this->test->getUserTicketList($param1);
            return redirect()
            ->to('/test-response')->with('res',$data);
        } else if($test_route == 3) {
            $data = $this->test->getUserTicketDetail($param1,$param2);
            return redirect()
            ->to('/test-response')->with('res',$data);
        }
        else if($test_route == 4) {
            $data = $this->test->getReceivingTicketDetail($param1);
            return redirect()
            ->to('/test-response')->with('res',$data);
        }
    }
    public function getPurchaseTicket() {
        $tickets = $this->ticket->getTickets();
        return view('test.purchase',['tickets'=>$tickets,'res'=>json_encode(Session::get('res'))]);
    }
    public function postPurchaseTicket(Request $request) {
        $param1         = $request->input('param1');
        $data = $this->test->postPurchaseTicket($request->all(),$param1);
        return redirect()
        ->to('/test-purchase-ticket')->with('res',$data);
    }
    public function getSplitTicket() {
        return view('test.split',['res'=>json_encode(Session::get('res'))]); 
    }
    public function postSplitTicket(Request $request) {
        $param1 = $request->input('param1');
        $param2 = $request->input('param2');
        $data = $this->test->postSplitTicket($request->all(),$param1,$param2);
        return redirect()
        ->to('/test-split-ticket')->with('res',$data);
    }
    public function getReceiveTicket() {
        var_dump(\Session::get('access_token'));
        return view('test.receive', ['res'=>json_encode(Session::get('res'))]);
    }
    public function postReceiveTicket(Request $request) {
        $param1 = $request->input('param1');
        $data   = $this->test->postReceiveTicket($request->all(),$param1);
        return redirect()->to('/test-receive-ticket')->with('res',$data);
    }
    public function getStartTicket() {
        return view('test.start', ['res'=>json_encode(Session::get('access_token')['expires'])]);
    }
    public function postStartTicket(Request $request) {
        $param1 = $request->input('param1');
        $param2 = $request->input('param2');
        $data = $this->test->postStartTicket($param1,$param2);
        return redirect()->to('/test-start-ticket')->with('res',$data);
    }

}
