<?php

namespace App\Modules\Jobs\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVacancyRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Middleware handles access
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'requirements' => 'sometimes|required|string',
            'location' => 'sometimes|required|string|max:255',
            'salary_range' => 'sometimes|nullable|string|max:255',
            'type' => 'sometimes|required|string|in:full-time,part-time,contract,remote,internship',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
