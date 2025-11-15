<?php

namespace Database\Factories;

use App\Enums\ApplicationStatusEnum;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VacancyApplication>
 */
class VacancyApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statuses = [
            ApplicationStatusEnum::PENDING->value,
            ApplicationStatusEnum::REVIEWED->value,
            ApplicationStatusEnum::INTERVIEW->value,
            ApplicationStatusEnum::OFFER_SENT->value,
            ApplicationStatusEnum::HIRED->value,
            ApplicationStatusEnum::REJECTED->value,
        ];

        return [
            'vacancy_id' => Vacancy::factory(),
            'user_id' => User::factory(),
            'resume' => $this->faker->filePath(),
            'cover_letter' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
