<?php

namespace App\Models;

use App\Traits\HasCreator;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasUuids, HasCreator, HasFactory, HasSlug;

    public function vacancies(): HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    public function verifications()
    {
        return $this->hasMany(CompanyVerification::class);
    }
}
