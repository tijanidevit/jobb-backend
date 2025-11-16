<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Seeder;

class CompanyDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo-company@example.com'],
            User::factory()->state([
                'role' => 'company'
            ])->raw()
        );

        // Step 2: Ensure the company exists for this user (factory if creating)
        $company = Company::firstOrCreate(
            ['user_id' => $user->id],
            Company::factory()->state([
                'user_id' => $user->id
            ])->raw()
        );

        // Step 3: Ensure vacancies exist for this company
        if ($company->vacancies()->count() === 0) {
            Vacancy::factory(5)->create([
                'company_id' => $company->id
            ]);
        }
    }
}
