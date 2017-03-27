<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Exceptions\AjaxException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Session;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($e instanceOf AjaxException){
            if($e->getStatusCode() == 401){
                return response()->json([
                    'errors' => [[$e->getMessage()]]
                ], 401);
            }else{
                return response()->json([
                    'errors' => [[$e->getMessage()]]
                ], 400);
            }
        }elseif($e instanceOf HttpException){
            if($e->getStatusCode() == 401){
                Session::flush();
                return redirect('/auth/login');
            }elseif($e->getStatusCode() != 400){
                switch($e->getStatusCode()){
                    case 404:
                        $message = 'Page Not Found';
                        break;
                    case 503:
                        $message = 'Be right back';
                        break;
                    default:
                        $message = !empty($e->getMessage()) ? $e->getMessage() : 'error occured';
                        break;
                }
                return response()->view('errors.show', [
                    'message' => $message
                ], $e->getStatusCode());
            }
        }elseif($e instanceof TokenMismatchException){
            $message = 'Session has expired';
            return response()->view('errors.show', [
                'message' => $message
            ]);
        }
        return parent::render($request, $e);
    }
}
