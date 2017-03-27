<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Exception;
use App\Exceptions\AjaxException;
use App\ApiResponse;

class ApiModel
{

    static function call($method, $url, $params=array(), $ajax=false)
    {
        try{
            $client = new Client();

            $params = self::convertTimezone($params);
            $params['client_secret']   = env('API_SECRET');
            $params['client_name']     = env('API_CLIENT_NAME');

            if($method == "GET"){
                $count = 0;
                $lastItem = count($params) - 1;
                foreach($params as $key => $param) {
                    if($count == 0) $url .= '?';
                    $url .= $key."=".$param;
                    if($count != $lastItem) $url .= '&';
                    $count++;
                }
            }
            
            $res = $client->request($method, $url, [
                'form_params' => $params,
                'headers' => [
                    'Accept-Language' => \App::getLocale(),
                ],
            ]);

            return new ApiResponse($res);
            
        }catch (RequestException $e) {
            if ($e->hasResponse()){
                $statusCode = $e->getResponse()->getStatusCode();
                $message = json_decode($e->getResponse()->getBody())->message;
                if($statusCode == 412 || $statusCode == 422){
                    return new ApiResponse($e->getResponse());
                }else{
                    if($ajax){
                        throw new AjaxException($statusCode, $message);
                    }else{
                        throw new HttpException($statusCode, $message);
                    }
                }
            }
            if($ajax){
                throw new AjaxException(400, "Api Error");
            }else{
                throw new HttpException(400, "Api Error");
            }
        }
    }

    static function callByAuth($method, $url, $params=array(), $ajax=false)
    {
        try{
            $client = new Client();

            $params = self::convertTimezone($params);
            $params['client_secret']   = env('API_SECRET');
            $params['client_name']     = env('API_CLIENT_NAME');

            if($method == "GET"){
                $count = 0;
                $lastItem = count($params) - 1;
                foreach($params as $key => $param) {
                    if($count == 0) $url .= '?';
                    $url .= $key."=".$param;
                    if($count != $lastItem) $url .= '&';
                    $count++;
                }
            }

            $res = $client->request($method, $url, [
                'form_params' => $params,
                'headers' => [
                    'Accept-Language' => \App::getLocale(),
                    'Authorization' => 'Bearer '.\Session::get('access_token')['value'],
                ],
            ]);

            return new ApiResponse($res);
            
        }catch (RequestException $e) {
            if ($e->hasResponse()){
                $statusCode = $e->getResponse()->getStatusCode();
                $message = json_decode($e->getResponse()->getBody())->message;
                if($statusCode == 412 || $statusCode == 422){
                    return new ApiResponse($e->getResponse());
                }else{
                    if($ajax){
                        throw new AjaxException($statusCode, $message);
                    }else{
                        throw new HttpException($statusCode, $message);
                    }
                }
            }
            if($ajax){
                throw new AjaxException(400, "Api Error");
            }else{
                throw new HttpException(400, "Api Error");
            }
        }
    }

    static function convertTimezone($content){
        if(is_array($content)){
            foreach($content as $k => $v){
                $content[$k] = static::convertTimezone($v);
            } 
        }elseif(is_object($content)){
            foreach($content as $k => $v){
                $content->{$k} = static::convertTimezone($v);
            } 
        }elseif(!is_null($content) && $content === date("Y-m-d H:i:s", strtotime($content))){
            $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $content);
            $date->setTimezone('UTC');
            $content = $date->toDateTimeString();
            $date->setTimezone(config("app.timezone"));
        }
        return $content;
    } 

}
