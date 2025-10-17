<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calca>
 */
class CalcaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
        'modelo',
        'cos',
        'vinco',
        'bainha',
        'bolsos',
        'presilhas',
        'botoes',
         */
        return [
            'modelo' => $this->faker->word(),
            'cos' => $this->faker->word(),
            'vinco' => $this->faker->word(),
            'bainha' => $this->faker->word(),
            'bolsos' => $this->faker->word(),
            'presilhas' => $this->faker->word(),
            'botoes' => $this->faker->word(),
        ];
    }
}
