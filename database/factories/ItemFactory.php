<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['Pendente', 'Em Produção', 'Concluído']),
            'itemable_type' => \App\Models\Casaco::class,
            'itemable_id' => \App\Models\Casaco::factory(),
            'encomenda_id' => \App\Models\Encomenda::factory(),
            'descricao' => $this->faker->sentence(),
            'quantidade' => $this->faker->numberBetween(1, 5),
        ];
    }
}
