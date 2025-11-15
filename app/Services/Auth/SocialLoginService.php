<?php

namespace App\Services\User\Auth;

use App\Helpers\ApiResponse;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\Auth\AuthTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginService extends ApiResponse
{

    use AuthTrait;

    public function __construct(protected User $user) {
    }

    public function getUrl(string $provider): JsonResponse
    {
        $url = Socialite::driver($provider)->scopes($this->getScopes($provider))->stateless()->redirect()->getTargetUrl();
        return $this->successResponse(data: $url);
    }

    public function handleCallback(string $provider, $code): JsonResponse
    {
        $socialUser = Socialite::driver($provider)->stateless()
        ->getAccessTokenResponse($code);

        $token = $socialUser['access_token'];

        $socialUser = Socialite::driver($provider)
            ->stateless()
            ->userFromToken($token);

        $user = User::firstOrCreate(
            ['email' => $socialUser->getEmail() ?? $socialUser->user['notification_email']],
            [
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'profile_image' => $socialUser->getAvatar() ?? $socialUser->user['profile_image'],
                'email_verified_at' => now(),
                'ref_code' => $this->user->getRefCode(),
                'last_login' => now(),
                'last_activity' => now(),
                'password' => Hash::make(uniqid()),
                'social_provider_id' => $socialUser->getId(),
                'social_provider' => $provider,
            ]
        );

        $user->generateApiKeys();

        $token = $this->getAuthToken($user);
        return $this->successResponse("Authentication successful", compact('user', 'token'));
    }

    private function getScopes($provider) : array {
        return match ($provider) {
            'google' => ['openid', 'profile', 'email'],
        };
    }
}
