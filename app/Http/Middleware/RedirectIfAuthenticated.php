<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if(Session::has('access_token')) {
            \Log::info(Session::get('access_token')['value']);
            if( strtotime(Session::get('access_token')['expires']) > strtotime(date('Y-m-d H:i:s')) ) {
                return redirect('/');
            }
            return $next($request);
        }
        return $next($request);
    }
}
