<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
      * @var Item
      */
    protected $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @type POST
     * @param $request,$id
     * @desc Update User input By User Id, Retreive User Information By User Id
     */
    public function UserRegistration(Request $request)
    {
        $_regtype = $request->input('_regtype');
        $usr = (object) array(); 
        $resopnse = (object) array(); 

        if ($request->isMethod('post') && strtolower($_regtype) == strtolower('Validate')){

            $usr = (object)$request->all();
            if (!isset($usr->email_magazine_subscribed)) {
                $usr->email_magazine_subscribed = 0;
            }
            $response = $this->user->ValidateRegistUser((array)$usr);
            if($response->result == config('define.result.success')){
                return view('users.reg-confirm')->with(compact('usr'));
            }

        } elseif ($request->isMethod('post') && strtolower($_regtype) == strtolower('Save')){

            $usr = (object)$request->all();
            if (!isset($usr->email_magazine_subscribed)) {
                $usr->email_magazine_subscribed = 0;
            }
            if (!isset($usr->service_term)) {
                $usr->service_term = 1;
            }
            $response = $this->user->RegistUser((array)$usr);
            if($response->result == config('define.result.success')){
                return view('users.reg-complete')->with(compact('response'));
            }

        } elseif ($request->isMethod('POST') && strtolower($_regtype) == strtolower('Back')){
             
            $usr = (object)$request->all(); 
            if (!isset($usr->email_magazine_subscribed)) {
                $usr->email_magazine_subscribed = 0;
            }

        }

        return view('users.reg-input')->with(compact('response', 'usr'));

    }

    /**
     * @type PUT, GET
     * @param $request,$id
     * @desc Update User input By User Id, Retreive User Information By User Id
     */
    public function UserInformation(Request $request,$id)
    {
        $_edittype = $request->input('_edittype');
        $usr = (object) array(); 
        $response = (object)array();

        if ($request->isMethod('POST') && strtolower($_edittype) == strtolower('Validate')){

            $usr = (object)$request->all();
            if (!isset($usr->email_magazine_subscribed)) {
                $usr->email_magazine_subscribed = 0;
            }
            if(!isset($usr->service_term)) {
                $usr->service_term = 1;
            }
            $response = $this->user->ValidateEditUser((array)$usr, $id);
            if($response->result == config('define.result.success')){
                return view('users.edit-confirm')->with(compact('usr', 'id'));
            }

        }elseif($request->isMethod('POST') && strtolower($_edittype) == strtolower('Save')){

            $usr = (object)$request->all();
            if (!isset($usr->email_magazine_subscribed)) {
                $usr->email_magazine_subscribed = 0;
            }
            if(!isset($usr->service_term)) {
                $usr->service_term = 1;
            }
            $response = $this->user->EditUserInformation((array)$usr,$id);
            if($response->result == config('define.result.success')){
                return view('users.edit-complete')->with(compact('response'));
            }

        }elseif($request->isMethod('POST') && strtolower($_edittype) == strtolower('Back')){

            $usr = (object)$request->all(); 

        }else{

            $usr = $this->user->GetUserInformation($id)->user;

        }

        return view('users.edit-input')->with(compact('response', 'usr', 'id'));
    }

}
