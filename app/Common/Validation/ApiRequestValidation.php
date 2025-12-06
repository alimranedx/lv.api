<?php

namespace App\Common\Validation;

use App\Common\Utility\ApiService;
use Illuminate\Support\Facades\Validator;

class ApiRequestValidation
{
    public static function validateRequest(array $input, array $rules, array $messages = []) : array
    {
        $status = '';
        $error_message = '';
        $error_messagees = '';
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            $status = ApiService::API_SERVICE_DEFAULT_VALIDATION_ERROR;
            $error_message = $validator->errors()->first();
            $error_messagees = $validator->errors();
        }
        return [
            'status' => $status,
            'message' => $error_message,
            'messages' => $error_messagees
        ];
    }
    public static function validateIndividualLoginRequest(array $input) : array
    {
        $rules = [
             'phone' => 'required|string|digits:11|regex:/^01[0-9]{9}$/',  // regex  phone validation start with 01 then 9 digits
             'password' => 'required|string|digits:6|regex:/[0-9]{6}$/'    // regex password validation start with 0-9 then 6 digits
        ];
        return self::validateRequest($input, $rules);
    }
    public static function validateSmsVerifyOfIndividualLogin(array $input) : array
    {
        $rules = [
            'user_id' => 'required|integer',
            'otp'     => 'required|digits:6|regex:/[0-9]{6}$/'
        ];
        return self::validateRequest($input, $rules);
    }
}
