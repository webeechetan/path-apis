<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'age' => fake()->numberBetween(1, 100),
            'doctor_id' => fake()->numberBetween(1, 10),
            'ref_by_id' => fake()->numberBetween(1, 10),
            'sub_test_id' => fake()->numberBetween(1, 10),
            'amount_paid' => fake()->randomFloat(2, 1, 1000),
            'amount_paid_online' => fake()->randomFloat(2, 1, 1000),
            'amount_paid_cash' => fake()->randomFloat(2, 1, 1000),
            'amount_due' => fake()->randomFloat(2, 1, 1000),
            'rcless' => fake()->randomFloat(2, 1, 1000),
            'test_status' => fake()->randomElement(['pending', 'completed']),
            'test_delivery_date' => fake()->date(),
        ];
    }
}
