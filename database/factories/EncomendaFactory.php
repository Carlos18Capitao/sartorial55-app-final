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
            // Valores exactamente como definidos na migration
            'estado' => $this->faker->randomElement([
                'PENDENTE',
                'EM_PROCESSAMENTO',
                'ENVIADA',
                'ENTREGUE',
                'CANCELADA',
            ]),
            'total' => $this->faker->randomFloat(2, 10, 1000),
            'observacoes' => $this->faker->optional()->sentence(),
        ];
    }
}

