<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyVerification extends Model
{
    use HasUuids, HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
