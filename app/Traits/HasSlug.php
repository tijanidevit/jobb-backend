<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Boot the trait.
     */
    public static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = $model->generateUniqueSlug($model->getSlogSource());
            }
        });
    }

    /**
     * Get the source value to generate the slug from.
     * Priority:
     * 1. $model->slog_source (attribute or property provided)
     * 2. 'name' attribute by default
     */
    protected function getSlogSource(): string
    {
        if (property_exists($this, 'slog_source') && !empty($this->slog_source)) {
            if (is_string($this->slog_source) && isset($this->{$this->slog_source})) {
                return $this->{$this->slog_source};
            }
        }

        return $this->name ?? '';
    }

    /**
     * Generate a unique slug for the model.
     */
    protected function generateUniqueSlug(string $source): string
    {
        $slug = Str::slug($source);
        $original = $slug;
        $i = 1;

        while (static::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i++;
        }

        return $slug;
    }
}
