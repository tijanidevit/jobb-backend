<?php

namespace Database\Factories;

use App\Enums\CompanyVerificationStatusEnum;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyVerification>
 */
class CompanyVerificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $documentTypes = ['cac', 'id_card', 'utility_bill'];
        $statuses = [
            CompanyVerificationStatusEnum::PENDING->value,
            CompanyVerificationStatusEnum::APPROVED->value,
            CompanyVerificationStatusEnum::REJECTED->value,
        ];

        return [
            'company_id' => Company::factory(),
            'document_type' => $this->faker->randomElement($documentTypes),
            'document' => $this->faker->filePath(),
            'status' => $this->faker->randomElement($statuses),
            'approval_note' => $this->faker->sentence(),
        ];
    }
}
