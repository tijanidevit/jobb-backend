<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyPasswordRequest;
use App\Services\Auth\PasswordService;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    use ResponseTrait;
    public function __construct(private PasswordService $passwordService) {}

    public function sendOtp(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        return $this->passwordService->sendOtp($request->email);
    }

    public function verify(VerifyPasswordRequest $request): JsonResponse
    {
        return $this->successMessageResponse('Password verified successfully');
    }

    public function reset(ResetPasswordRequest $request): JsonResponse
    {
        return $this->passwordService->reset($request->validated());
    }
}
