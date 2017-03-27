<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Payment;

class PaymentController extends Controller
{
    protected $payment;
    
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;    
    }
    
    protected function getShow($token)
    {
        $payment = $this->payment->getPayment($token);
        if($payment == false ||
           !empty($payment->transaction_response_code)){
            return view('errors.payment');
        }
        return view('payments.show', compact('payment'));
    }

    protected function postCharge($token, Request $request)
    {
        $response = $this->payment->charge($token, $request);
        if($response->result == config('define.result.success')){
            return redirect('payments/'.$token.'/result?pf_t='.$request->input('pf_t'));
        } else {
            $request->flash();
            $payment = $this->payment->getPayment($token);
            return view('payments.show', compact('payment', 'response'));
        }
    }

    protected function getResult($token)
    {
        $result = $this->payment->getResult($token);
        if($result != config("define.result.success")){
            return view('errors.payment');
        }
        return view('payments.complete');
    }
}
