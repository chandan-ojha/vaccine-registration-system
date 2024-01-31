<?php

namespace Database\Factories;

use App\Enums\VaccinationStatus;
use App\Models\Center;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vaccination>
 */
class VaccinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nid' => $this->faker->unique()->numerify('##########'),
            'phone' => $this->faker->unique()->numerify('###########'),
            'status' => $this->faker->randomElement(VaccinationStatus::class),
            'center_id' => Center::factory(),
        ];
    }
}
