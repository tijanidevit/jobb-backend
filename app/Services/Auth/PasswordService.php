<?php

namespace App\Services\User\Auth;

use App\Helpers\ApiResponse;
use App\Models\PasswordResetToken;
use App\Models\User;
use App\Notifications\User\Auth\PasswordReset\RequestTokenNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class PasswordService extends ApiResponse
{
    public function __construct(protected User $user, protected PasswordResetToken $passwordResetToken)
    {
    }

    public function reset(array $data): JsonResponse
    {
        return DB::transaction(function () use ($data) {
            $query = $this->passwordResetToken->where([
                'token' => $data['token'],
                'email' => $data['email'],
            ]);

            $passwordResetToken = $query->with('user')->first();

            $passwordResetToken->user->update([
                'password' => $data['password'],
            ]);

            $query->delete();

            return $this->successMessageResponse("Password reset successfully.");
        });
    }

    public function requestToken($email): JsonResponse
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            $passwordResetToken = $this->passwordResetToken->updateOrCreate(
            ['email' => $email],
            ['token' => rand(100000, 999999),]);
            $user->notify(new RequestTokenNotification($passwordResetToken->token));
        }

        return $this->successMessageResponse("Password reset token sent.");
    }
}
