<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;

class VerifyPasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $email = $this->input('email');
        $cachedToken = Cache::get("password_reset_{$email}");

        return [
            'email' => ['required', 'email', 'exists:users'],
            'token' => [
                'required',
                'string',
                Rule::in([$cachedToken]),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'token.in' => 'Invalid or expired reset code.',
        ];
    }
}
