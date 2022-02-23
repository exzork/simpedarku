<?php
namespace App\Traits;

trait ResponseTrait
{
    public function success($data = [], $code = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $code);
    }

    public function error($message = '', $code = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $code);
    }
}
