<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UploadLogoRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'logo' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
