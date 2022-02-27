<?php

namespace App\Exceptions;

use App\Traits\ResponseTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
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

        $this->renderable(function (Throwable $e, $request) {

            if($request->wantsJson()){
                if ($e instanceof AuthenticationException) {
                    return $this->error(null, 422, $e->getMessage());
                }

                if ($e instanceof ValidationException) {
                    return $this->error(['errors' => array_values(Arr::dot($e->validator->errors()->toArray()))], 422, $e->getMessage());
                }

                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return $this->error(null, $e->getStatusCode(), $e->getMessage());
                }

                if ($e->getPrevious() instanceof TokenMismatchException) {
                    return $this->error(null, $e->getStatusCode(), $e->getMessage());
                }
                if ($e instanceof HttpException) {
                    $message = match ($e->getStatusCode()) {
                        503 => 'Service unavailable',
                        500 => 'Internal server error',
                        404 => 'Not found',
                        405 => 'Method not allowed',
                        401 => 'Unauthorized',
                        400 => 'Bad request',
                        default => 'Unknown error',
                    };
                    return $this->error(null, $e->getStatusCode(),$e->getMessage() == "" ? $message : $e->getMessage());
                }
                return $this->error(null, 520, $e->getMessage());
            }
            return parent::render($request, $e);
        });
    }


    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->wantsJson()) {
            return $this->error(null, 401, "Unauthenticated.");
        }
        return parent::unauthenticated($request, $exception); // TODO: Change the autogenerated stub
    }
}
