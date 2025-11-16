<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vacancy extends Model
{
    use HasUuids, HasSlug, HasFactory;

    protected $slog_source = 'title';
    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications(): HasMany
    {
        return $this->hasMany(VacancyApplication::class);
    }

    public function application(): HasOne
    {
        return $this->hasOne(VacancyApplication::class)->latestOfMany();
    }

    public function savedByUsers(): HasMany
    {
        return $this->hasMany(SavedVacancy::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->where(function ($q) {
                         $q->whereNull('expires_at')
                           ->orWhere('expires_at', '>', now());
                     });
    }

    public function scopeExpired($query)
    {
        return $query->whereNotNull('expires_at')
                     ->where('expires_at', '<=', now());
    }

    public function scopeWithCompanyBasic($query)
    {
        return $query->select(
            'id',
            'category',
            'company_id',
            'title',
            'slug',
            'location',
            'type',
            'salary_min',
            'salary_max',
            'is_active',
            'expires_at',
            'created_at',
            'updated_at',
            'salary_currency',
            'level',
            'work_mode'
        )->with('company:id,name,slug,logo');
    }

    public function scopeFilterVacancies($query, $request) : Builder
    {
        return $query
            ->active()
            ->search('title', $request->input('search'))
            ->filterWhereIn([
                'category' => $request->input('categories'),
                'type' => $request->input('types'),
                'work_mode' => $request->input('work_modes'),
            ])
            ->when($request->filled('salary_range'), function ($q) use ($request) {
                [$min, $max] = explode('-', $request->input('salary_range'));
                $q->whereBetween('salary_min', [(float)$min, (float)$max]);
            })
            ->when($request->filled('sort_by'), function ($q) use ($request) {
                $sortBy = $request->input('sort_by');
                return match ($sortBy) {
                    'most_recent' => $q->sortResultBy('created_at', 'desc'),
                    'salary_high_low' => $q->sortResultBy('salary_min', 'desc'),
                    'salary_low_high' => $q->sortResultBy('salary_min', 'asc'),
                    default => $q
                };
            });
    }
}
