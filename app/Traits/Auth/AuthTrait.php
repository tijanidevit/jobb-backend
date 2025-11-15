<?php

namespace App\Traits\Auth;

use App\Models\User;
use Illuminate\Auth\Authenticatable;

trait AuthTrait
{
    public function getAuthToken(Authenticatable|User $user): string
    {
        return $user->createToken(config('routely.auth_token.key'))->plainTextToken;
    }
}
