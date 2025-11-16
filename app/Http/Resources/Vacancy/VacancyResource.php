<?php

namespace App\Http\Resources\Vacancy;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'category' => $this->category,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->whenNotNull($this->description),
            'location' => $this->location,
            'type' => $this->type,
            'salary_min' => $this->salary_min,
            'salary_max' => $this->salary_max,
            'salary_currency' => $this->salary_currency ?? 'NGN',
            'is_active' => $this->is_active,

            'level' => $this->level,
            'work_mode' => $this->work_mode,
            'requirements' => $this->whenNotNull($this->requirements),
            'benefits' => $this->whenNotNull($this->benefits),
            'questions' => $this->whenNotNull($this->questions),


            'expires_at' => $this->expires_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'company' => $this->whenLoaded('company'),
            'application' => $this->whenLoaded('application'),
        ];
    }
}
