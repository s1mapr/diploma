<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait HttpResponseTrait
{
    protected function success($data, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => "Request successful",
            'data' => $data
        ], $code);
    }

    protected function successWithoutData($message = null, $code = 200): JsonResponse
    {
        return response()->json([
            'status' => "Request successful",
            'message' => $message,
        ], $code);
    }

    protected function error($message = null, $code = 400): JsonResponse
    {
        return response()->json([
            'status' => "Request failed",
            'message' => $message,
        ], $code);
    }
}
