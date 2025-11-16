<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company(),
            'slug' => null, // handled by HasSlug trait
            'logo' => null,
            'industry' => $this->faker->companySuffix(),
            'description' => $this->faker->paragraph(),
            'website' => $this->faker->url(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'is_verified' => $this->faker->boolean(99),
        ];
    }
}
