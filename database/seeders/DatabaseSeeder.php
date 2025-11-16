<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    User,
    Company,
    Vacancy,
    VacancyApplication,
    SavedVacancy,
    CompanyVerification
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CompanyDemoSeeder::class
        ]);
    }
}
