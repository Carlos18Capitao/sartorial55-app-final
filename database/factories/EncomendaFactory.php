<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Encomenda>
 */
class EncomendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            'data_encomenda' => $this->faker->date(),
            'estado' => $this->faker->randomElement(['pendente', 'em_processamento', 'enviada', 'entregue', 'cancelada']),
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'observacoes' => $this->faker->optional()->sentence(),
        ];
    }
}

