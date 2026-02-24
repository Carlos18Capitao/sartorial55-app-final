<?php

namespace Database\Factories;

use App\Models\MedidaCamisa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedidaCamisa>
 */
class MedidaCamisaFactory extends Factory
{
    protected $model = MedidaCamisa::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'colarinho' => $this->faker->randomFloat(2, 35, 45),
            'ombro_ombro' => $this->faker->randomFloat(2, 40, 55),
            'peito' => $this->faker->randomFloat(2, 90, 120),
            'cintura' => $this->faker->randomFloat(2, 75, 105),
            'anca' => $this->faker->randomFloat(2, 85, 115),
            'bicep' => $this->faker->randomFloat(2, 25, 40),
            'comprimento_manga_direita' => $this->faker->randomFloat(2, 55, 65),
            'comprimento_manga_esquerda' => $this->faker->randomFloat(2, 55, 65),
            'comprimento_manga_curta' => $this->faker->randomFloat(2, 20, 30),
            'punho_esquerdo' => $this->faker->randomFloat(2, 15, 22),
            'punho_direito' => $this->faker->randomFloat(2, 15, 22),
            'comprimento' => $this->faker->randomFloat(2, 65, 80),
        ];
    }
}

