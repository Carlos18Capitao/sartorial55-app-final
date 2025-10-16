<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Casaco>
 */
class CasacoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'modelo' => $this->faker->randomElement(\App\Emun\ModeloCasacoEnum::cases())->value,
            'lapela' => $this->faker->word(),
            'bolsos' => $this->faker->word(),
            'forro' => $this->faker->word(),
            'botao' => $this->faker->word(),
            'manga' => $this->faker->word(),
            'costas' => $this->faker->word(),
            'acabamento' => $this->faker->word(),
            'status' => $this->faker->randomElement(['Pendente', 'Em Produção', 'Concluído']),
        ];
    }
}
