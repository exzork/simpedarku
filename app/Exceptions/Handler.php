<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ResponseTrait;
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

        $this->renderable(function (HttpException $e, $request) {
            if ($e->getPrevious() instanceof TokenMismatchException) {
                return $request->expectsJson()
                    ? $this->error([], 419, "CSRF token mismatch.")
                    : redirect()->guest(route('login'));
            }
        });

        $this->renderable(function (ValidationException $e, $request) {
            return $request->expectsJson()
                ? $this->error(['errors'=>array_values(Arr::dot($e->validator->errors()->toArray()))], 422, 'Invalid Parameters')
                : $e->getResponse();
        });

    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return $this->error([], 401, "Unauthenticated.");
        }
        return parent::unauthenticated($request, $exception); // TODO: Change the autogenerated stub
    }
}
