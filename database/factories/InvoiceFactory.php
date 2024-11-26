<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => (string) Str::uuid(),
            'emissionDate' => now(),
            'maturityDate' => now()->addDays(10),
            'amount' => $this->faker->randomFloat(2, 1000, 100000),
            'receiptType' => $this->faker->randomElement(['P', 'I', 'AB']),
            'status' => $this->faker->randomElement(['A', 'R', 'P', 'C']),
            'idExternal' => $this->faker->randomNumber(2),
        ];
    }
}
