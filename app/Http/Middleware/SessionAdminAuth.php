<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;

class SessionAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function handle($request, Closure $next)
    {
        if(Session::has('access_token')) {
            if(isAdmin() == false) {
                return redirect('/admin/auth/login');
            }
            if( strtotime(Session::get('access_token')['expires']) > strtotime(date('Y-m-d H:i:s')) ) {
                return $next($request);
            }
            $pass_reissueToken  = array('refresh_token' => Session::get('refresh_token')); 
            $api                = $this->user->getReissueToken($pass_reissueToken);
            if($api == false) {
                Session::flush();
                return redirect('/admin/auth/login');
            }
            Session::forget('access_token');
            Session::set('access_token',['value'=>$api->access_token,'expires'=>$api->expired_date]);
            return $next($request);
        }
        return redirect('/admin/auth/login');
    }
}
