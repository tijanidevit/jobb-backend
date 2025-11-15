<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $types = ['full_time', 'part_time', 'remote', 'hybrid', 'internship'];

        return [
            'company_id' => Company::factory(),
            'title' => $this->faker->jobTitle(),
            'slug' => null, // handled by HasSlug trait
            'description' => $this->faker->paragraph(3),
            'location' => $this->faker->city(),
            'type' => $this->faker->randomElement($types),
            'salary_min' => $this->faker->numberBetween(50000, 150000),
            'salary_max' => $this->faker->numberBetween(150001, 300000),
            'is_active' => true,
            'expires_at' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
        ];
    }
}
