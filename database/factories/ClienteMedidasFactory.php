<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClienteMedidas>
 */
class ClienteMedidasFactory extends Factory
{
    protected $model = ClienteMedidas::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory(),
            // Medidas da Camisa
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
            'comprimento_camisa' => $this->faker->randomFloat(2, 65, 80),
            // Medidas do Casaco
            'base' => $this->faker->randomFloat(2, 45, 60),
            'distancia_ombro_botao' => $this->faker->randomFloat(2, 30, 45),
            'comprimento_manga_casaco' => $this->faker->randomFloat(2, 55, 65),
            'bicep_casaco' => $this->faker->randomFloat(2, 28, 42),
            'boca_manga' => $this->faker->randomFloat(2, 12, 18),
            'meia_cinta' => $this->faker->randomFloat(2, 40, 55),
            'meio_ombro' => $this->faker->randomFloat(2, 20, 28),
            'meia_costa' => $this->faker->randomFloat(2, 35, 48),
            'comprimento_costa' => $this->faker->randomFloat(2, 65, 80),
            'comprimento_frente' => $this->faker->randomFloat(2, 60, 75),
            'racha_lateral_casaco' => $this->faker->randomFloat(2, 15, 30),
            // Medidas do Colete
            'tamanho_colete' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL']),
            'ombro_botao_colete' => $this->faker->randomFloat(2, 30, 45),
            'comprimento_frente_colete' => $this->faker->randomFloat(2, 55, 70),
            'comprimento_costa_colete' => $this->faker->randomFloat(2, 50, 65),
            'meia_cinta_colete' => $this->faker->randomFloat(2, 35, 50),
            // Medidas da Calça
            'tamanho_calca' => $this->faker->randomElement(['28', '30', '32', '34', '36', '38', '40']),
            'cintura_calca' => $this->faker->randomFloat(2, 70, 100),
            'anca_calca' => $this->faker->randomFloat(2, 85, 110),
            'coxa' => $this->faker->randomFloat(2, 50, 70),
            'joelho' => $this->faker->randomFloat(2, 35, 50),
            'comprimento_calca' => $this->faker->randomFloat(2, 95, 115),
            'bainha' => $this->faker->randomFloat(2, 5, 15),
            'gancho_frente' => $this->faker->randomFloat(2, 20, 30),
            'gancho_atras' => $this->faker->randomFloat(2, 25, 40),
        ];
    }

    /**
     * Indicate that the medidas belong to a specific cliente.
     */
    public function forCliente(Cliente $cliente): static
    {
        return $this->state(fn (array $attributes) => [
            'cliente_id' => $cliente->id,
        ]);
    }
}

