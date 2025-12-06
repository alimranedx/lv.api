<?php

namespace App\Common\Utility;

class ApiResponse
{
    public static function sendResponse($data = [], $status = 200)
    {
        return response()->json($data, $status);
    }
}
