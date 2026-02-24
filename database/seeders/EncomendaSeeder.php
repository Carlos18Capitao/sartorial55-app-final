<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Encomenda;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EncomendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = Cliente::all();

        if ($clientes->isEmpty()) {
            $this->command->warn('No clientes found. Please run ClienteSeeder first.');
            return;
        }

        // Create 2-5 encomendas for each cliente
        foreach ($clientes as $cliente) {
            $encomendaCount = rand(2, 5);

            for ($i = 0; $i < $encomendaCount; $i++) {
                Encomenda::create([
                    'cliente_id' => $cliente->id,
                    'data_encomenda' => now()->subDays(rand(1, 60)),
                    'estado' => $this->getRandomEstado(),
                    'total' => rand(50, 500),
                    'observacoes' => rand(0, 1) ? 'Encomenda padrão' : null,
                ]);
            }
        }
    }

    /**
     * Get a random estado with weighted probability.
     */
    private function getRandomEstado(): string
    {
        $estados = [
            'pendente' => 20,
            'em_processamento' => 20,
            'enviada' => 20,
            'entregue' => 30,
            'cancelada' => 10,
        ];

        $random = rand(1, 100);
        $cumulative = 0;

        foreach ($estados as $estado => $probability) {
            $cumulative += $probability;
            if ($random <= $cumulative) {
                return $estado;
            }
        }

        return 'pendente';
    }
}

