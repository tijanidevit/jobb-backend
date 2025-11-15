<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class CompanyVerification extends Model
{
    use HasUuids;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
