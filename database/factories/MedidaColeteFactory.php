<?php

namespace Database\Factories;

use App\Models\MedidaColete;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedidaColete>
 */
class MedidaColeteFactory extends Factory
{
    protected $model = MedidaColete::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tamanho' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
            'ombro_botao' => $this->faker->randomFloat(2, 30, 45),
            'comprimento_frente' => $this->faker->randomFloat(2, 55, 70),
            'comprimento_costa' => $this->faker->randomFloat(2, 50, 65),
            'meia_cinta' => $this->faker->randomFloat(2, 35, 50),
        ];
    }
}

