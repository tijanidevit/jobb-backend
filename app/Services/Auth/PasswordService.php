<?php

namespace App\Services\Auth;

use App\Helpers\ApiResponse;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\Auth\PasswordResetCodeNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PasswordService extends ApiResponse
{
    public function __construct(protected User $user)
    {
    }

    public function reset($data): JsonResponse
    {
        $user = User::where('email', $data['email'])->firstOrFail();

        $user->password = $data['password'];
        $user->save();

        Cache::forget("password_reset_{$user->email}");

        return $this->successMessageResponse('Password has been reset successfully.');
    }


    public function sendOtp($email): JsonResponse
    {
        $user = User::where('email', $email)->first();

        $token = random_int(100000, 999999);

        Cache::put("password_reset_{$user->email}", $token, 3600);

        $user->notify(new PasswordResetCodeNotification($token));

        return $this->successMessageResponse('Password reset code sent to your email.');
    }
}
