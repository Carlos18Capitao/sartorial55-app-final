<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Camisa>
 */
class CamisaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'colarinho' => $this->faker->word(),
            'punho' => $this->faker->word(),
            'pincas' => $this->faker->word(),
            'carcela' => $this->faker->word(),
            'acabamento' => $this->faker->word(),
        ];
    }
}
