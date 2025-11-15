<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UploadVerificationRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'document_type' => 'required|string',
            'document' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ];
    }
}
