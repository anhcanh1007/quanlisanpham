<?php

namespace App\Trait;

trait ApiResponse
{
    public function successResponse($message = "", $data = [])
    {
        $result['message'] = $message;
        $result['data'] = $data;
        return response()->json($result, 200);
    }

    public function errorResponse($message = "", $data = [])
    {
        $result['message'] = $message;
        $result['data'] = $data;
        return response()->json($result, 422);
    }

    public function baseResponse($message = "", $data = [], $status)
    {
        $result['message'] = $message;
        $result['data'] = $data;
        return response()->json($result, $status);
    }
}