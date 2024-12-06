<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
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
            'active' => $this->faker->boolean(),
            'personType' => $this->faker->randomElement(['F', 'J']),
            'name' => $this->faker->name(),
            'cnpj_cpf' => $this->faker->cnpjCpf(),
            'birthDate' => $this->faker->date('Y-m-d'),
            'registrationDate' => $this->faker->date('Y-m-d'),
            'idExternal' => $this->faker->randomNumber(2),
        ];
    }
}
