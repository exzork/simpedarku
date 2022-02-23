<?php

namespace App\Http\Responses;
use App\Traits\ResponseTrait;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{

    use ResponseTrait;

    public function toResponse($request)
    {
        // TODO: Implement toResponse() method.
        $user = auth()->user();
        return $this->success($user, 201);
    }
}
