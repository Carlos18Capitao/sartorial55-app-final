<?php

namespace Database\Factories;

use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use App\Models\MedidaCamisa;
use App\Models\MedidaCasaco;
use App\Models\MedidaColete;
use App\Models\MedidaCalca;
use App\Models\ClienteMedidas;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemEncomenda>
 */
class ItemEncomendaFactory extends Factory
{
    protected $model = ItemEncomenda::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = ['camisa', 'fato', 'casaco', 'calca', 'colete'];
        $tipo = $this->faker->randomElement($tipos);

        return [
            'encomenda_id' => Encomenda::factory(),
            'tipo' => $tipo,
            'foto' => $this->faker->optional(0.7)->imageUrl(400, 300, 'fashion'),
            // Estados em UPPER_SNAKE
            'estado' => $this->faker->randomElement([
                'PENDENTE',
                'EM_PRODUCAO',
                'PRONTO',
                'ENVIADO',
                'ENTREGUE',
            ]),
            'observacoes' => $this->faker->optional(0.5)->sentence(),
            'data_envio' => $this->faker->optional(0.3)->date(),
            'data_previsao' => $this->faker->optional(0.7)->dateTimeBetween('+1 week', '+2 months'),
        ];
    }

    /**
     * Indicate that the item is a camisa.
     */
    public function camisa(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'camisa',
            'medida_type' => MedidaCamisa::class,
        ])->afterCreating(function (ItemEncomenda $item) {
            $medida = MedidaCamisa::factory()->create();
            $item->update(['medida_id' => $medida->id]);
        });
    }

    /**
     * Indicate that the item is a casaco.
     */
    public function casaco(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'casaco',
            'medida_type' => MedidaCasaco::class,
        ])->afterCreating(function (ItemEncomenda $item) {
            $medida = MedidaCasaco::factory()->create();
            $item->update(['medida_id' => $medida->id]);
        });
    }

    /**
     * Indicate that the item is a colete.
     */
    public function colete(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'colete',
            'medida_type' => MedidaColete::class,
        ])->afterCreating(function (ItemEncomenda $item) {
            $medida = MedidaColete::factory()->create();
            $item->update(['medida_id' => $medida->id]);
        });
    }

    /**
     * Indicate that the item is a calca.
     */
    public function calca(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'calca',
            'medida_type' => MedidaCalca::class,
        ])->afterCreating(function (ItemEncomenda $item) {
            $medida = MedidaCalca::factory()->create();
            $item->update(['medida_id' => $medida->id]);
        });
    }

    /**
     * Indicate that the item is a fato (suit).
     */
    public function fato(): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'fato',
            'medida_type' => null,
            'medida_id' => null,
        ]);
    }

    /**
     * Indicate that the item has been sent.
     */
    public function enviado(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'ENVIADO',
            'data_envio' => $this->faker->date(),
        ]);
    }

    /**
     * Indicate that the item has been delivered.
     */
    public function entregue(): static
    {
        return $this->state(fn (array $attributes) => [
            'estado' => 'ENTREGUE',
            'data_envio' => $this->faker->date(),
        ]);
    }

    /**
     * Indicate that the item belongs to a specific encomenda.
     */
    public function forEncomenda(Encomenda $encomenda): static
    {
        return $this->state(fn (array $attributes) => [
            'encomenda_id' => $encomenda->id,
        ]);
    }

    /**
     * Create a camisa with default measurements from ClienteMedidas.
     */
    public function camisaWithDefaultMedidas(ClienteMedidas $defaultMedidas): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'camisa',
            'cliente_medidas_id' => $defaultMedidas->id,
        ])->afterCreating(function (ItemEncomenda $item) {
            $item->createMedidaFromDefault();
        });
    }

    /**
     * Create a colete with default measurements from ClienteMedidas.
     */
    public function coleteWithDefaultMedidas(ClienteMedidas $defaultMedidas): static
    {
        return $this->state(fn (array $attributes) => [
            'tipo' => 'colete',
            'cliente_medidas_id' => $defaultMedidas->id,
        ])->afterCreating(function (ItemEncomenda $item) {
            $item->createMedidaFromDefault();
        });
    }
}

