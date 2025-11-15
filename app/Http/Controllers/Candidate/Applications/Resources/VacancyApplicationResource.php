<?php

namespace App\Modules\Applications\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VacancyApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'job_id' => $this->vacancy_id,
            'candidate_id' => $this->candidate_id,
            'status' => $this->status,
            'rejection_note' => $this->rejection_note,
            'offer_letter' => $this->offer_letter,
            'resume' => $this->resume,
            'cover_letter' => $this->cover_letter,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,


            // Relations
            'candidate' => $this->whenLoaded('creator'),
            'vacancy' => $this->whenLoaded('vacancy'),
        ];
    }
}
