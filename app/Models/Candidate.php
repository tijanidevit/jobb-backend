<?php

namespace App\Models;

use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Candidate extends Model
{
    use HasCreator, HasUuids, HasFactory;

    protected $guarded = ['id'];


    public function vacanciesApplied()
    {
        return $this->hasMany(VacancyApplication::class);
    }

    public function savedVacancies()
    {
        return $this->hasMany(SavedVacancy::class);
    }

    public function resumes() : HasMany {
        return $this->hasMany(CandidateResume::class);
    }

    public function educations() : HasMany {
        return $this->hasMany(CandidateEducation::class);
    }

    public function experiences() : HasMany {
        return $this->hasMany(CandidateExperience::class);
    }

    public function skills() : HasMany {
        return $this->hasMany(CandidateSkill::class);
    }

}
