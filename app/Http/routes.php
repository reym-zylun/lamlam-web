<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['session_auth']], function () {
    // user edit
    Route::match(['get', 'post'],'/users/{id}/edit',
        [
            'as'   => 'user.editmethod',
            'uses' => 'UserController@UserInformation'
        ]
    );
    // receive ticket
    Route::get('/users/{id}/tickets/receive', 'UserTicketController@getReceive');
    Route::post('/users/{id}/tickets/receive', 
        [
            'as'   => 'receive-post',
            'uses' => 'UserTicketController@postReceive'
        ]
    );
    // user ticket
    Route::get('/users/{id}/tickets',
        [
            'as'   => 'user.tickets',
            'uses' => 'UserTicketController@getIndex'
        ]
    );
    // user cancel tickets
    Route::get('/users/{id}/tickets/cancel',
        [
            'as'   => 'user.tickets.cancel-select',
            'uses' => 'UserTicketController@getCancelTickets'
        ]
    );
    // user ticket detail
    Route::get('/users/{id}/tickets/{user_ticket_id}',
        [
            'as'   => 'user.tickets.show',
            'uses' => 'UserTicketController@getShow'
        ]
    );
    Route::match(['get', 'post'], '/users/{id}/tickets/{user_ticket_id}/cancel',
        [ 
            'as'   => 'user.tickets.cancel',
            'uses' => 'UserTicketController@cancel'
        ]
    );

    Route::post('/users/{id}/tickets/{user_ticket_id}/use', 'UserTicketController@postUse');   
    Route::post('/users/{id}/tickets/{user_ticket_id}/split', 'UserTicketController@postSplit');

    // payment ticket
    Route::post('/users/{id}/payments/start',
        [
            'as'   => 'user.payments.start',
            'uses' => 'UserTicketController@postPaymentStart'
        ]
    );
});

Route::group(['middleware' => ['web']], function () {
    Route::get('lang/{lang}',
        [
            'as'   => 'lang.switch',
            'uses' => 'LanguageController@switchLang'
        ]
    );
    // top
    Route::get('/', 
        [
            'as'   => 'top',
            'uses' => 'IndexController@getIndex'
        ]
    );
    // Authentication routes...
    Route::get('/auth/login',
        [
            'as'   => 'login',
            'uses' => 'Auth\AuthController@getLogin'
        ]
    );
    Route::get('/admin/auth/login', ['as'=>'admin.login', 'uses' => 'Auth\AuthController@getLogin']);
    Route::post('/auth/login',
        [
            'as'   => 'login',
            'uses' => 'Auth\AuthController@postLogin'
        ]
    );
    Route::post('/admin/auth/login', ['as'=>'admin.login', 'uses' => 'Auth\AuthController@postLogin']);
    Route::get('/auth/logout',
        [
            'as'   => 'logout',
            'uses' => 'Auth\AuthController@logout'
        ]
    );
    // user create
    Route::match(['get', 'post'], '/users/regist', 
        [
            'as'   => 'user.regmethod',
            'uses' => 'UserController@UserRegistration'
        ]
    );
    // ticket
    Route::get('/tickets',
        [
            'as'   => 'ticket-list',
            'uses' => 'TicketController@getIndex'
        ]
    );
    Route::match(['get', 'post'], '/tickets/{id}',
        [ 
            'as'   => 'ticket-purchase',
            'uses' => 'TicketController@purchase'
        ]
    );
    // password ressuie
    Route::get('/password', 
        [
            'as'   => 'password',
            'uses' => 'Auth\PasswordController@getReissue'
        ]
    );
    Route::post('/password', 
        [
            'as'   => 'passowrd',
            'uses' => 'Auth\PasswordController@postReissue'
        ]
    );
    // contact
    Route::match(['get', 'post'],'/contact',
        [
            'as'   => 'user.contactmethod',
            'uses' => 'ContactController@ContactMessaging'
        ]
    );
    // payment
    Route::get('/payments/{token}',
        [
            'as'   => 'payment.show',
            'uses' => 'PaymentController@getShow'
        ]
    );
    Route::post('/payments/{token}',
        [
            'as'   => 'payment.charge',
            'uses' => 'PaymentController@postCharge'
        ]
    );
    Route::get('/payments/{token}/result',
        [
            'as'   => 'payment.result',
            'uses' => 'PaymentController@getResult'
        ]
    );
    // Privary Policy 
    Route::get('/privacy-policy', function(){
        return Response::view('privacy-policy'); 
    });
    // Service Term 
    Route::get('/terms-and-conditions', function(){
        return Response::view('terms-and-conditions'); 
    });
    // App open or go to shopp 
    Route::get('/openapp', function(){
        if (preg_match('/(iPhone|iPad|iPod) OS (\d+)[\.|_]+(\d+)/', Request::header('User-Agent'), $matches)){
            if($matches[2] >= 9){
                return redirect(config("define.store_url.ios")); 
            }
            $platform = "ios";
        } elseif (preg_match('/Android/', Request::header('User-Agent'))){
            $platform = "android";
        }else{
            return redirect('/');
        }
        return Response::view('openapp',['platform' => $platform]); 
    });
    // Ad Recirect
    Route::get('/ads/{id}/redirect',
        [
            'as'   => 'ad.redirect',
            'uses' => 'AdController@getRedirect'
        ]
    );
    
});

Route::group(['middleware' => ['session_admin_auth']], function () {
    // INDEX
    Route::get('/admin',                        ['as' => 'admin.index', 'uses' => 'Admin\TicketController@getIndex']);

    // TICKETS
    Route::get('/admin/tickets',                ['as' => 'admin.tickets', 'uses' => 'Admin\TicketController@getIndex']);
    Route::post('/admin/tickets/create',        ['as' => 'admin.tickets_create', 'uses' => 'Admin\TicketController@postCreate']);
    Route::get('/admin/tickets/{id}',           ['as' => 'admin.tickets_view', 'uses' => 'Admin\TicketController@getEdit']);
    Route::post('/admin/tickets/{id}',          ['as' => 'admin.tickets_update', 'uses' => 'Admin\TicketController@putEdit']);
    Route::delete('/admin/tickets/{id}/delete', ['as' => 'admin.tickets_delete', 'uses' => 'Admin\TicketController@getDelete']);

    // INFORMATIONS
    Route::get('/admin/informations',           ['as' => 'admin.informations', 'uses' => 'Admin\InformationController@getIndex']);
    Route::post('/admin/informations/create',   ['as' => 'admin.informations_create', 'uses' => 'Admin\InformationController@postCreate']);
    Route::get('/admin/informations/{id}',      ['as' => 'admin.informations_view', 'uses' => 'Admin\InformationController@getEdit']);
    Route::put('/admin/informations/{id}',      ['as' => 'admin.informations_update', 'uses' => 'Admin\InformationController@putEdit']);
    Route::delete('/admin/informations/{id}/delete',      ['as' => 'admin.informations_delete', 'uses' => 'Admin\InformationController@getDelete']);

    // PASSCODES
    Route::match(['get'],'/admin/passcodes',              ['as' => 'admin.passcodes', 'uses' => 'Admin\PasscodeController@getIndex']);
    Route::delete('/admin/passcodes/{id}/delete',                 ['as' => 'admin.passcodes_delete', 'uses' => 'Admin\PasscodeController@getDelete']);
    Route::post('/admin/passcodes/create',                        ['as' => 'admin.passcodes_create', 'uses' => 'Admin\PasscodeController@postCreate']);

    // SALES
    Route::match(['get', 'post'],'/admin/sales',              ['as' => 'admin.sales', 'uses' => 'Admin\SaleController@getIndex']);

    // USERS
    Route::get('/admin/users',                  ['as' => 'admin.users', 'uses' => 'Admin\UserController@getIndex']);
    Route::get('/admin/users/{id}',             ['as' => 'admin.users_view', 'uses' => 'Admin\UserController@getEdit']);
    Route::put('/admin/users/{id}',             ['as' => 'admin.users_update', 'uses' => 'Admin\UserController@putUpdate']);

    // MAP 
    Route::get('/admin/map',  [
        'as' => 'admin.map',
        'uses' => 'Admin\MapController@getIndex'
    ]);
    Route::post('/admin/map/busstops',  [
        'as' => 'admin.map.regist.busstops',
        'uses' => 'Admin\MapController@postRegistBusStops'
    ]);
    Route::post('/admin/map/buscourses',  [
        'as' => 'admin.map.regist.buscourses',
        'uses' => 'Admin\MapController@postRegistBusCourses'
    ]);

});
