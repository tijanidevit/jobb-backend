<?php

namespace App\Services\Auth;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService extends ApiResponse
{
    public function register(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'password' => $data['password'],
        ]);

        Auth::login($user);
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->createdResponse('User registered successfully', [
            'user' => $user,
            'token' => $token
        ]);
    }

    public function login(array $data)
    {
        if (!Auth::attempt($data)) {
            return $this->unauthorizedResponse('Invalid credentials');
        }

        $user = Auth::user();
        $token = $user->createToken('api-token')->plainTextToken;

        return $this->successResponse('Login successful', [
            'user' => $user,
            'token' => $token
        ]);
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
        return $this->successMessageResponse('Logged out successfully');
    }
}
