<?php

namespace App\Services\Auth;

use App\Helpers\ApiResponse;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Notifications\Auth\ConfirmEmailNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use function Symfony\Component\Clock\now;

class AuthService extends ApiResponse
{
    public function register(array $data): JsonResponse
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'],
        ]);

        Auth::login($user);

        $token = $user->createToken('api-token')->plainTextToken;

        $this->sendOtp($user);


        return $this->createdResponse('User registered successfully', [
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function login(array $data): JsonResponse
    {
        if (!Auth::attempt($data)) {
            return $this->unauthorizedResponse('Invalid credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse('Login successful', [
            'user' => new UserResource($user),
            'token' => $token
        ]);
    }

    public function verifyEmail(): JsonResponse
    {
        $user = Auth::user();
        $user->email_verified_at = now();

        $user->save();

        Cache::forget("verify_email_{$user->email}");

        return $this->successResponse('Email Verified Successfully', new UserResource($user));
    }

    public function sendEmailOtp(): JsonResponse
    {
        $user = Auth::user();
        if ($user->email_verified_at) {
            return $this->successMessageResponse('Email already verified');
        }

        $this->sendOtp($user);
        return $this->successMessageResponse('Email OTP sent successfully');
    }

    public function logout($user): JsonResponse
    {
        $user->currentAccessToken()->delete();
        return $this->successMessageResponse('Logged out successfully');
    }

    private function sendOtp($user) : void {
        $code = random_int(100000, 999999);
        Cache::put("verify_email_{$user->email}", $code, 3600);
        $user->notify(new ConfirmEmailNotification($code));
    }
}
