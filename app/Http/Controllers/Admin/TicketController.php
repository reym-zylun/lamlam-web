<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Ticket;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{

    public function __construct(Ticket $ticket) {
        $this->ticket = $ticket;
    }

    public function getIndex(Request $request) {
        $status = array();
        $params = array();
        $prev_search        = array();
        $params['offset']   = config('define.perPage');

        if($request->has('status')) {
            $params['status'] = $request->input('status');
            $status = ['status' => $request->input('status')];
        }

        if($request->has('page')) {
            $params['page'] = $request->input('page');
        }

        if($request->has('search')) {
            $params['search']      = $request->input('search');
            $prev_search['search'] = $request->input('search');
        }

        $params['admin'] = 1;
        $_tickets = $this->ticket->getTickets($params);
        $tickets = $_tickets->tickets;
        $pagination = $_tickets->pagination;

        return view('admin.tickets.index')->with(compact('tickets', 'status','pagination','prev_search'));
    }

    public function postCreate(Request $request) {
        if ($request->hasFile('image_file')) {
                $validator = \Validator::make($request->all(), [
                'image_file' => 'mimes:jpeg,bmp,png|max:1000'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'message' => 'Validation Error.',
                    'errors'  => $validator->errors()
                ], 200);
            }
            $file = $request->file('image_file');
            $path = public_path().config('define.ticket_image_path');
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $name = 'lamcar-'.time().'.'.$extension;

            $file->move($path,$name);
            $request->merge(array('file' => config('define.ticket_image_path').$name));
        }
        $ticket = $this->ticket->registerTicket($request->all());
        return response()->json($ticket, 200);
    }

    public function getEdit($id) {
        $ticket = $this->ticket->getAdminTicket($id);
        return response()->json($ticket, 200);
    }

    public function putEdit(Request $request, $id) {
        if ($request->hasFile('image_file')) {
                $validator = \Validator::make($request->all(), [
                'image_file' => 'mimes:jpeg,bmp,png|max:1000'
            ]);

            if($validator->fails()) {
                return response()->json([
                    'message' => 'Validation Error.',
                    'errors'  => $validator->errors()
                ], 200);
            }
            $file = $request->file('image_file');
            $path = public_path().config('define.ticket_image_path');
            $extension = $request->file('image_file')->getClientOriginalExtension();
            $name = 'lamcar-'.time().'.'.$extension;

            $file->move($path,$name);
            $request->merge(array('file' => config('define.ticket_image_path').$name));
        }
        $ticket = $this->ticket->updateTicket($request->all(), $id);
        return response()->json($ticket, 200);
    }

    public function getDelete(Request $request, $id) {
        $ticket = $this->ticket->deleteTicket($request->all(), $id);
        return response()->json($ticket, 200);
    }

}
