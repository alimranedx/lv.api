<?php

namespace App\Http\Controllers\Api;

use App\Common\Services\UserService;
use App\Common\Utility\ApiResponse;
use App\Common\Utility\ApiService;
use App\Common\Validation\ApiRequestValidation;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * STEP 1 → REGISTRATION
     * Creates user and sends OTP for verification
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|unique:users,phone',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // generate OTP
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);

        // TODO: integrate your SMS gateway
        // Sms::send($user->phone, "Your OTP is: $otp");

        return response()->json([
            'message' => 'Register successful. OTP sent.',
            'user_id' => $user->id,
            'debug_otp' => $otp  // remove in production
        ]);
    }


    /**
     * STEP 2 → Individual Login
     * Phone + Password → Send OTP
     */
    public function individualLogin(Request $request)
    {
        list($status, $message, $data) = (new UserService())->individualLogin( $request->all());
        return ApiResponse::sendResponse([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ]);
    }


    /**
     * STEP 3 → SMS Verification
     * OTP → return Sanctum token
     */
    public function smsVerify(Request $request)
    {
        list($status,$message, $data) = (new UserService())->smsVerify($request->all());

        return ApiResponse::sendResponse([
            'status' => $status,
            'message'   => $message,
            'data'    => $data
        ]);
    }
}
