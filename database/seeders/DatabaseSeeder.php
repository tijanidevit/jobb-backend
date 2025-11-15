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
        // Create 10 users
        User::factory(10)->create();

        // Create 5 companies (each with a user)
        Company::factory(5)->create()->each(function ($company) {
            // Each company gets 3-5 vacancies
            Vacancy::factory(rand(3,5))->create(['company_id' => $company->id]);

            // Each company gets 1-2 verifications
            CompanyVerification::factory(rand(1,2))->create(['company_id' => $company->id]);
        });

        // Random applications from users to vacancies
        $vacancies = Vacancy::all();
        $users = User::all();

        foreach ($users as $user) {
            foreach ($vacancies->random(rand(1,3)) as $vacancy) {
                VacancyApplication::factory()->create([
                    'user_id' => $user->id,
                    'vacancy_id' => $vacancy->id,
                ]);

                SavedVacancy::factory()->create([
                    'user_id' => $user->id,
                    'vacancy_id' => $vacancy->id,
                ]);
            }
        }
    }
}
