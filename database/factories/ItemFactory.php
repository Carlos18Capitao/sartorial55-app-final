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
        $itemableTypes = [\App\Models\Casaco::class, \App\Models\Calca::class, \App\Models\Fato::class, \App\Models\Camisa::class];
        $itemableType = $this->faker->randomElement($itemableTypes);

        $itemableId = null;
        switch ($itemableType) {
            case \App\Models\Casaco::class:
                $itemableId = \App\Models\Casaco::factory()->create()->id;
                break;
            case \App\Models\Calca::class:
                $itemableId = \App\Models\Calca::factory()->create()->id;
                break;
            case \App\Models\Fato::class:
                $itemableId = \App\Models\Fato::factory()->create()->id;
                break;
            case \App\Models\Camisa::class:
                $itemableId = \App\Models\Camisa::factory()->create()->id;
                break;
        }

        return [
            'status' => $this->faker->randomElement(['Pendente', 'Em Produção', 'Concluído']),
            'itemable_type' => $itemableType,
            'itemable_id' => $itemableId,
            'encomenda_id' => \App\Models\Encomenda::factory(),
            'descricao' => $this->faker->sentence(),
            'quantidade' => $this->faker->numberBetween(1, 5),
        ];
    }
}
