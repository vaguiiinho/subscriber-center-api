<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
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
            'street' => $this->faker->street(),
            'number' => $this->faker->randomNumber(5),
            'neighborhood' => $this->faker->neighborhood(),
            'complement' => $this->faker->complement(),
            'city' => $this->faker->city(),
        ];
    }
}
