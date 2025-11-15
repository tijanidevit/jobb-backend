<?php

namespace App\Http\Requests\Auth;

use App\Enums\User\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => [
                'required',
                Rule::in(UserRoleEnum::toArray())
            ],
            'password' => 'required|string|min:6',
        ];
    }
}
