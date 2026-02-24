<?php

namespace Database\Factories;

use App\Models\MedidaCasaco;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedidaCasaco>
 */
class MedidaCasacoFactory extends Factory
{
    protected $model = MedidaCasaco::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'base' => $this->faker->randomFloat(2, 45, 60),
            'distancia_ombro_botao' => $this->faker->randomFloat(2, 30, 45),
            'comprimento_manga' => $this->faker->randomFloat(2, 55, 65),
            'bicep' => $this->faker->randomFloat(2, 28, 42),
            'boca_manga' => $this->faker->randomFloat(2, 12, 18),
            'meia_cinta' => $this->faker->randomFloat(2, 40, 55),
            'meio_ombro' => $this->faker->randomFloat(2, 20, 28),
            'meia_costa' => $this->faker->randomFloat(2, 35, 48),
            'comprimento_costa' => $this->faker->randomFloat(2, 65, 80),
            'comprimento_frente' => $this->faker->randomFloat(2, 60, 75),
            'racha_lateral' => $this->faker->randomFloat(2, 15, 30),
        ];
    }
}

