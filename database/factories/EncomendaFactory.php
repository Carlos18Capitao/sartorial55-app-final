<?php

namespace Database\Factories;

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
            'numero' => $this->faker->unique()->numerify('ENC-#####'),
            'data' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => $this->faker->randomElement(['Pendente', 'Em Produção', 'Concluída']),
            'observacao' => $this->faker->optional()->sentence(),
            'cliente_id' => \App\Models\Cliente::factory(),
        ];
    }
}
