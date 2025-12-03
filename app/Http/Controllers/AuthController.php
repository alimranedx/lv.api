<?php

namespace App\Http\Controllers;

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
     * STEP 2 → LOGIN STEP 1
     * Phone + Password → Send OTP
     */
    public function loginStepOne(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('phone', $request->phone)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid phone or password'], 401);
        }

        // generate OTP
        $otp = rand(100000, 999999);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5)
        ]);

        return response()->json([
            'message' => 'OTP sent',
            'user_id' => $user->id,
            'debug_otp' => $otp
        ]);
    }


    /**
     * STEP 3 → LOGIN STEP 2
     * OTP → return Sanctum token
     */
    public function loginStepTwo(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'otp'     => 'required'
        ]);

        $user = User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if ($user->otp !== $request->otp) {
            return response()->json(['error' => 'Invalid OTP'], 401);
        }

        if (Carbon::parse($user->otp_expires_at)->isPast()) {
            return response()->json(['error' => 'OTP expired'], 401);
        }

        // clear OTP
        $user->update([
            'otp' => null,
            'otp_expires_at' => null
        ]);

        // generate token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token'   => $token,
            'user'    => $user
        ]);
    }
}
