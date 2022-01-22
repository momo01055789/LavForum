<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if($e instanceof TokenInvalidException){
            return response(['error'=>'token is not valid'],Response::HTTP_METHOD_NOT_ALLOWED);
        }
        elseif($e instanceof TokenBlacklistedException){
            return response(['error'=>'token can not be used,it is blacklisted'],Response::HTTP_METHOD_NOT_ALLOWED);
        }
        elseif($e instanceof TokenExpiredException){
            return response(['error'=>'token can not be used,it is expired'],Response::HTTP_METHOD_NOT_ALLOWED);
        }
        elseif($e instanceof JWTException){
            return response(['error'=>'token is not provided'],Response::HTTP_METHOD_NOT_ALLOWED);
        }
        return parent::render($request, $e);
    }
}
