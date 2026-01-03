<?php

namespace App\Common\Validation;

use App\Common\Utility\ApiService;
use Illuminate\Support\Facades\Validator;

class AppRequestValidation
{
    public static function validateRequest(array $input, array $rules, array $messages = []) : array
    {
        $status_code = '';
        $status_message = '';
        $error_messages = '';
        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            $status_code = ApiService::API_SERVICE_DEFAULT_VALIDATION_ERROR;
            $status_message = $validator->errors()->first();
            $error_messages = $validator->errors();
        }
        return [
            'status_code' => $status_code,
            'status_message' => $status_message,
            'error_messages' => $error_messages
        ];
    }

    public static function validateBrandStoreRequest($input)
    {
        return self::validateRequest($input, [
            'name' => 'required|string|max:255|unique:brands',
            'slug' => 'required|string|max:255|unique:brands',
            'brand_image' => 'sometimes|image|mimes:jpg,jpeg,png,webp',
            'is_active' => 'required|integer'
        ]);
    }
    public static function validateBrandUpdateRequest($input, $id)
    {
        return self::validateRequest($input, [
            'name' => 'required|string|max:255|unique:brands,name,'. $id,
            'slug' => 'required|string|max:255|unique:brands,slug,'. $id,
            'is_active' => 'required|integer'
        ]);
    }
    public static function validateProductStoreRequest($input)
    {
        return self::validateRequest($input, [
            'brand_id' => 'required|integer',
            'name' => 'required|string|max:255|unique:products',
            'slug' => 'required|string|max:255|unique:products',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stoke' => 'sometimes|integer',
            'is_active' => 'required|integer'
        ]);
    }
    public static function validateProductUpdateRequest($input, $id)
    {
        return self::validateRequest($input, [
            'brand_id' => 'required|integer',
            'name' => 'required|string|max:255|unique:products,name,'. $id,
            'slug' => 'required|string|max:255|unique:products,slug,'. $id,
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stoke' => 'sometimes|integer',
            'is_active' => 'required|integer',
        ]);
    }
}
