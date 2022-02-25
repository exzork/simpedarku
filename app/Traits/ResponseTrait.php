<?php
namespace App\Traits;

trait ResponseTrait
{
    public function success($data = null, $code = 200, $message="")
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message'=> $message
        ], $code);
    }

    public function error($data = null, $code = 400, $message = '')
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message
        ], $code);
    }
}
