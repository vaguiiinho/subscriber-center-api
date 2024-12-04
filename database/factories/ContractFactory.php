<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
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
            'activationDate' => now(),
            'renewalDate' => now()->addDays(10),
            'contractStatus' => $this->faker->randomElement(['P', 'A', 'I', 'N', 'D']),
            'internetStatus' => $this->faker->randomElement(['A', 'D', 'CM', 'FA', 'AA']),
            'idExternal' => $this->faker->randomNumber(2),
        ];
    }
}
