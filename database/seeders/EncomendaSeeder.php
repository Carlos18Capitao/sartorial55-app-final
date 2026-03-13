<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\ClienteMedidas;
use App\Models\Encomenda;
use App\Models\ItemEncomenda;
use App\Models\MedidaCamisa;
use App\Models\MedidaCasaco;
use App\Models\MedidaColete;
use App\Models\MedidaCalca;
use Illuminate\Database\Seeder;

class EncomendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar clientes com medidas default
        $clientes = Cliente::factory()
            ->count(45)
            ->create()
            ->each(function ($cliente) {
                // Criar medidas default para cada cliente
                ClienteMedidas::factory()->create([
                    'cliente_id' => $cliente->id,
                ]);
            });

        // Para cada cliente, criar algumas encomendas
        $clientes->each(function ($cliente) {
            $encomendas = Encomenda::factory()
                ->count(1)
                ->create([
                    'cliente_id' => $cliente->id,
                ]);

            $encomendas->each(function ($encomenda) {
                // Criar itens para cada encomenda
                $numItens = rand(1, 4);

                for ($i = 0; $i < $numItens; $i++) {
                    $tipo = $this->getRandomTipo();
                    $this->criarItemComMedida($encomenda, $tipo);
                }
            });
        });
    }

    /**
     * Get a random item type.
     */
    private function getRandomTipo(): string
    {
        $tipos = ['camisa', 'casaco', 'colete', 'calca'];
        return $tipos[array_rand($tipos)];
    }

    /**
     * Create item with corresponding measure.
     */
    private function criarItemComMedida(Encomenda $encomenda, string $tipo): void
    {
        $item = ItemEncomenda::factory()->create([
            'encomenda_id' => $encomenda->id,
            'tipo' => $tipo,
        ]);

        $medida = match ($tipo) {
            'camisa' => MedidaCamisa::factory()->create(),
            'casaco' => MedidaCasaco::factory()->create(),
            'colete' => MedidaColete::factory()->create(),
            'calca' => MedidaCalca::factory()->create(),
            default => null,
        };

        if ($medida) {
            $item->update([
                'medida_type' => get_class($medida),
                'medida_id' => $medida->id,
            ]);
        }
    }
}

