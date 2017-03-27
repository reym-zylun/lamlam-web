<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\User;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->middleware('guest');
        $this->user = $user;
    }

    public function getReissue()
    {
        return view('auth.password.input');
    }

    public function postReissue(Request $request) {
        
        $input = $request->input();
        $response = $this->user->reissuePassword($input);

        if($response->result == config("define.result.success")){
            return view('auth.password.complete');
        }else{
            $input = (object)$input;
            return view('auth.password.input')->with(compact('response','input'));
        }
        
    }

}
