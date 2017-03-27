<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function getLogin(Request $request)
    {
        if(\Route::getCurrentRoute()->getName() == 'admin.login') {
            return view('admin.auth.login');
        }
        return view('auth.login');
    }

    protected function postLogin(Request $request)
    {
        Session::forget('access_token');
        Session::forget('refresh_token');
        Session::forget('user');
        $response = $this->user->getAccessToken($request->all());
        if($response->result == config('define.result.success')){
            Session::set('access_token',
                [
                    'value'   => $response->access_token,
                    'expires' => $response->expired_date
                ]
            );
            Session::set('refresh_token',$response->refresh_token);
            Session::set('user',$response->user);
            if(isAdmin() == true && \Route::getCurrentRoute()->getName() == 'admin.login') {
                return redirect()->route('admin.tickets');
            }
            return redirect('/');
        }
        $request->flash();
        if(\Route::getCurrentRoute()->getName() == 'admin.login') {
            return view('admin.auth.login')->with(compact('response'));
        }
        return view('auth.login')->with(compact('response'));
    }
    protected function logout() {
        if ( strpos(url()->previous(), 'admin') !== false ) {
            Session::flush();
            return redirect()->route('admin.login');
        } else {
            Session::flush();
            return redirect()->to('/auth/login'); 
        }
    }
}
