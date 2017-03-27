<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Ticket;
use App\Information;

class IndexController extends Controller
{

    public function __construct(Ticket $ticket, Information $information)
    {
        $this->ticket = $ticket;
        $this->information = $information;
    }
    public function getIndex()
    {
        $params['purchasable'] = "1";
        $params['latest']   = 6;
        $ticketsTmp = $this->ticket->getTickets($params);
        $ticketsTmp = $ticketsTmp->tickets;
        $tickets['recommended'] = [];
        $tickets['day'] = [];
        $tickets['time'] = [];
        foreach($ticketsTmp as $ticket){
            $tickets[$ticket->type][] = $ticket;
            if($ticket->recommended){
                $tickets['recommended'][] = $ticket;
            }
        }

        $infos = $this->information->getInformations($params);
        $infos = $infos->informations;
        return view('index')->with(compact('tickets'))->with(compact('infos'));
    }

}
