<?php

namespace App;

use Carbon\Carbon;

Class ApiResponse 
{ 
    private $statusCode;
    private $body;

    public function __construct($response){
        $this->statusCode = $response->getStatusCode(); 
        $this->body = self::convertTimezone(
            json_decode($response->getBody())
        ); 
        if(is_null($this->body)){
            $this->body =  new \stdClass;
        }
        if(!isset($this->body->result)){
             if (preg_match("/^2[0-9]{2}$/", $this->statusCode)) {
                 $this->body->result = config("define.result.success");
             }else{
                 $this->body->result = config("define.result.failure");
             }
        }
    } 

    public function getStatusCode(){
        return $this->statusCode; 
    }

    public function getBody(){
        return $this->body; 
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
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $content, 'UTC');
            $date->setTimezone(config("app.timezone"));
            $content = $date->toDateTimeString();
        }
        return $content;
    } 

}
