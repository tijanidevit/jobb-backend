<?php

namespace App\Modules\Company\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'website' => $this->website,
            'location' => $this->location,
            'logo' => $this->logo ? asset('storage/' . $this->logo) : null,
            'is_verified' => $this->is_verified,
            'verification_document' => $this->verification_document ? asset('storage/' . $this->verification_document) : null,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
