<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Response;
use App\ApiModel;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','email_magazine_subscribed'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function __construct(ApiModel $api)
    {
        $this->api = $api;
    }

    public function getAccessToken($data)
    {
        $res = $this->api->call('POST',env('API_URL').'/auth/login',$data);
        return $res->getBody();
    }

    public function getReissueToken($data)
    {
        $res = $this->api->callByAuth('POST',env('API_URL').'/auth/refresh', $data);
        return $res->getBody();
    }

     public function reissuePassword($data) 
    {
        $res = $this->api->call('POST', env('API_URL').'/password',$data);
        return $res->getBody();
    }

    /**
     * Validate inputed Fields
     * @param $request
     * @desc Validate User Input
     */
    public function ValidateRegistUser($request)
    {
        $res = $this->api->call("POST", env('API_URL')."/users",  $request);
        return $res->getBody();
    }
    
    /**
     * Register a User
     * @param $request
     * @desc Create New User
     */
    public function RegistUser($request)
    {
        $res = $this->api->call("POST", env('API_URL')."/users",  $request);
        return $res->getBody();
    
    }
    
    /**
     * @type GET
     * @param $request,$id
     * @desc Get User Infomation By User Id
     */
    public function GetUserInformation($id)
    {
        $res = $this->api->callByAuth("GET", env('API_URL')."/users/{$id}",  array());
        return $res->getBody();
    }
    
    /**
     * Validate inputed Fields
     * @param $request,$id
     * @desc Validate User input By User Id
     */
    public function ValidateEditUser($request,$id)
    {
        $res = $this->api->callByAuth("PUT", env('API_URL')."/users/{$id}",  $request);
        return $res->getBody();
    }
    
    /**
     * Edit User Information
     * @param $request,$id
     * @desc Update User input By User Id
     */
    public function EditUserInformation($request,$id)
    {
        $res = $this->api->callByAuth("PUT", env('API_URL')."/users/{$id}",  $request);
        return $res->getBody();
    }

    public function getUsersforAdmin($request) {
        $res = $this->api->callByAuth("GET", env('API_URL')."/users",  $request);
        return $res->getBody();
    }
         
}
