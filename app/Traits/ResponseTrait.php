<?php
namespace App\Traits;

trait ResponseTrait
{
    public function success($data = [], $code = 200, $message="")
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message'=> $message
        ], $code);
    }

    public function error($message = '', $code = 400, $data = [])
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
