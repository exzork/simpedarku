<?php

namespace App\Http\Responses;
use App\Traits\ResponseTrait;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    use ResponseTrait;

    public function toResponse($request)
    {
        // TODO: Implement toResponse() method.
        $user = auth()->user();
        return $this->success($user, 200);
    }
}
