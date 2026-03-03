<?php

namespace Database\Factories;

use App\Models\MedidaCalca;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedidaCalca>
 */
class MedidaCalcaFactory extends Factory
{
    protected $model = MedidaCalca::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tamanho' => $this->faker->randomElement(['28', '30', '32', '34', '36', '38', '40']),
            'cintura' => $this->faker->randomFloat(2, 70, 100),
            'anca' => $this->faker->randomFloat(2, 85, 110),
            'coxa' => $this->faker->randomFloat(2, 50, 70),
            'joelho' => $this->faker->randomFloat(2, 35, 50),
            'comprimento' => $this->faker->randomFloat(2, 95, 115),
            'bainha' => $this->faker->randomFloat(2, 5, 15),
            'gancho_frente' => $this->faker->randomFloat(2, 20, 30),
            'gancho_atras' => $this->faker->randomFloat(2, 25, 40),
        ];
    }
}

