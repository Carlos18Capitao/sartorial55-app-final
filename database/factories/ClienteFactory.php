<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'telefone' => $this->faker->phoneNumber(),
        ];
    }

    /**
     * Indicate that the cliente has default medidas.
     */
    public function withMedidas(): static
    {
        return $this->has(\App\Models\ClienteMedidas::factory());
    }
}
