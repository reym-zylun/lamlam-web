<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Route;

class ActionLog
{
    public function handle($request, Closure $next)
    {
        $account = (object)['id' => null, 'name' => null, 'role' => null];
        if (Session::has('user')) {
            $account->id   = Session::get('user')->id;
            $account->name = Session::get('user')->name;
            $account->role = Session::get('user')->role;
        }

        $input = array();
        if (Route::getCurrentRoute()->getName() != 'payment.charge'){
            $input = $request->all();
        }

        $log = $request->server('REMOTE_ADDR')."\t".
               $request->server('REQUEST_METHOD')."\t".
               $request->server('REQUEST_URI')."\t".
               http_response_code()."\t".
               $request->server('HTTP_REFERER')."\t".
               $request->server('HTTP_USER_AGENT')."\t".
               $account->id."\t".
               $account->name."\t".
               $account->role."\t".
               serialize(array_map(array($this, "removeLineFeed"), $input));
        $log_dir  = storage_path("logs/action/".date("Ym"));
        if (!is_dir($log_dir)) {
            mkdir($log_dir, 0777, true);
        }
        $log_file = $log_dir."/".date("Ymd").".log";
        error_log(date("[Y-m-d H:i:s]")." -- ".$log.PHP_EOL, 3, $log_file); 

        return $next($request);
    }

    public function removeLineFeed($text){
        return str_replace(array("\r\n", "\r", "\n"), "", $text);
    }   

}

