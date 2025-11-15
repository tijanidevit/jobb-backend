<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class VerifyEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = Auth::user();
        $cachedToken = Cache::get("verify_email_{$user->email}");

        return [
            'token' => [
                'required',
                'string',
                Rule::in([$cachedToken]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'token.in' => 'Invalid or expired verification code.',
        ];
    }
}
