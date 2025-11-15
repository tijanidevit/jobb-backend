<?php

namespace App\Models;

use App\Enums\VacancyApplicationStatusEnum;
use App\Traits\HasCreator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class VacancyApplication extends Model
{
    use HasUuids, HasFactory, HasCreator;

    public function vacancy(): BelongsTo
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function scopeHired($query) : Builder {
        return $query->where('status', VacancyApplicationStatusEnum::HIRED->value);
    }
}
