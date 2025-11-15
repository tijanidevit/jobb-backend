<?php

namespace App\Http\Requests\Candidate\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'profile' => 'required|array',

            'profile.phone' => 'nullable|string|max:255',
            'profile.bio' => 'nullable|string',
            'profile.portfolio' => 'nullable|url',
            'profile.location' => 'nullable|string|max:255',
            'profile.avatar' => 'nullable|string|max:255',

            'skills' => 'nullable|array',
            'skills.*.skill' => 'required|string|max:255',
            'skills.*.level' => 'nullable|string|max:255',

            'resumes' => 'nullable|array',
            'resumes.*.title' => 'required|string|max:255',
            'resumes.*.resume' => 'required|string|max:255',
            'resumes.*.cover_letter' => 'nullable|string',

            'experiences' => 'nullable|array',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date',
            'experiences.*.description' => 'nullable|string',

            'educations' => 'nullable|array',
            'educations.*.institution_name' => 'required|string|max:255',
            'educations.*.course' => 'required|string|max:255',
            'educations.*.grade' => 'nullable|string|max:255',
            'educations.*.start_date' => 'required|date',
            'educations.*.end_date' => 'nullable|date',
        ];

    }
}
