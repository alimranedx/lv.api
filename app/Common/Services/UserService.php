<?php

namespace App\Common\Services;

use App\Common\Utility\ApiService;
use App\Common\Utility\Exception;
use App\Common\Validation\ApiRequestValidation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function individualLogin($requestData)
    {
        $status = '';
        $message = '';
        $data = [];
        try{
            $validator = ApiRequestValidation::validateIndividualLoginRequest($requestData);
            if(!empty($validator['status'])){
                $status = $validator['status'];
                $message = $validator['message'];
            }
            if(empty($status)){
                $user = (new User())->findByphone($requestData['phone']);
                if(empty($user)){
                    $status = ApiService::API_SERVICE_FAILED_CODE;
                    $message = 'User not found';
                }
            }
            if(empty($status) && !Hash::check($requestData['password'], $user->password)){
                $status = ApiService::API_SERVICE_FAILED_CODE;
                $message = 'Invalid phone or password';
            }
            if(empty($status)){
                $status = ApiService::API_SERVICE_SUCCESS_CODE;
                $message = ApiService::API_SERVICE_STATUS_MESSAGE[$status];
                // generate OTP 6 digit
                $otp = rand(100000, 999999);

                $user->update([
                    'otp' => $otp,
                    'otp_expires_at' => now()->addMinutes(5)
                ]);
                $data['user'] = $user->only(['id', 'name', 'phone']);
                $data['debug_otp'] = $otp;
            }
        }catch (\Throwable $th){
            $status = ApiService::API_SERVICE_DEFAULT_VALIDATION_ERROR;
            $message = Exception::fullMessage($th);
        }
        return [$status, $message, $data];
    }
    public function smsVerify($requestData){
        $status = '';
        $message = '';
        $data = [];
        try{
            $validator = ApiRequestValidation::validateSmsVerifyOfIndividualLogin($requestData);
            if(!empty($validator['status'])){
                $status = $validator['status'];
                $message = $validator['message'];
            }
            if(empty($status)){
                $user = (new User())->findById($requestData['user_id']);
                if (empty($user)) {
                    $status = ApiService::API_SERVICE_FAILED_CODE;
                    $message = 'User not found';
                }
            }
            if(empty($status) && $user->otp !== $requestData['otp']){
                $status = ApiService::API_SERVICE_FAILED_CODE;
                $message = 'Invalid OTP';
            }
            if(empty($status) && Carbon::parse($user->otp_expires_at)->isPast()){
                $status = ApiService::API_SERVICE_FAILED_CODE;
                $message = 'OTP expired';
            }
            if(empty($status)){
                $user->updateById($user->id,[
                    'otp' => null,
                    'otp_expires_at' => null
                ]);
                // generate token
                $token = $user->createToken('auth_token')->plainTextToken;
                $status = ApiService::API_SERVICE_SUCCESS_CODE;
                $message = ApiService::API_SERVICE_STATUS_MESSAGE[$status];
                $data['access_token'] = $token;
                $data['user'] = $user->only(['id', 'name', 'phone']);
            }
        }catch (\Throwable $th){
            $status = ApiService::API_SERVICE_DEFAULT_VALIDATION_ERROR;
            $message = Exception::fullMessage($th);
        }
        return [$status, $message, $data];
    }
}
