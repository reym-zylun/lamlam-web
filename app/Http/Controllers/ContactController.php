<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Contact;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller 
{
    /**
      * @var Item
      */
    protected $contact;
 
    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
   
    /**
     * @type POST
     * @param $request
     * @desc Contact Sending Message
     */
    public function ContactMessaging(Request $request)
    {
        
        $con = array();
        $_registtype = $request->input('_registtype');
        $response = (object)array();
                                               
        if ($request->isMethod('POST') && strtolower($_registtype) == strtolower('Validate')){
            $con = $request->all();
            $response = $this->contact->ValidateContact($con);
            if($response->result == config('define.result.success')){
                $con = (object)$con;
                return view('contact.confirm')->with(compact('con', 'response'));
            }
        }elseif ($request->isMethod('POST') && strtolower($_registtype) == strtolower('Regist')){
            $con = $request->all();
            $response = $this->contact->ProcessContact($con);
            if($response->result == config('define.result.success')){
                return view('contact.complete')->with(compact('response'));
            }
        }elseif ($request->isMethod('POST') && strtolower($_registtype) == strtolower('Back')){
            $con = $request->all();
        }
          
        $con = (object)$con;
        return view('contact.input')->with(compact('response', 'con'));
    }
  
}
