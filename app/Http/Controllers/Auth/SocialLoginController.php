<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Social\ResolveCodeRequest;
use App\Services\User\Auth\SocialLoginService;
use Illuminate\Http\JsonResponse;

class SocialLoginController extends Controller
{

    public function __construct(protected SocialLoginService $socialLoginService){}


    public function getUrl(string $provider): JsonResponse
    {
        return $this->socialLoginService->getUrl($provider);
    }

    public function handleCallback(ResolveCodeRequest $request, string $provider): JsonResponse
    {
        return $this->socialLoginService->handleCallback($provider, $request->code);
    }
}
