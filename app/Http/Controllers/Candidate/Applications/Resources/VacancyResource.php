<?php

namespace App\Modules\Jobs\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company_id' => $this->company_id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'location' => $this->location,
            'job_type' => $this->job_type,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'salary_currency' => $this->salary_currency,
            'is_active' => $this->is_active,
            'expires_at' => $this->expires_at,
            'approval_note' => $this->approval_note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'company' => new CompanyResource($this->whenLoaded('company')),
        ];
    }
}
