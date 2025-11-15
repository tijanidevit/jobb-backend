<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->authService->register($request->validated());
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authService->login($request->validated());
    }

    public function verifyEmail(VerifyEmailRequest $request): JsonResponse
    {
        return $this->authService->verifyEmail();
    }

    public function sendEmailOtp(): JsonResponse
    {
        return $this->authService->sendEmailOtp();
    }

    public function logout(): JsonResponse
    {
        $user = auth()->user();
        return $this->authService->logout($user);
    }
}
