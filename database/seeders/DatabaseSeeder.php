<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Criar 10 clientes com encomendas
        \App\Models\Cliente::factory(10)->create()->each(function ($cliente) {
            // Cada cliente tem pelo menos 1 encomenda
            $numEncomendas = rand(1, 3);
            $cliente->encomendas()->saveMany(
                \App\Models\Encomenda::factory($numEncomendas)->make()
            )->each(function ($encomenda) {
                // Cada encomenda tem pelo menos 1 item
                $numItens = rand(1, 5);
                $encomenda->itens()->saveMany(
                    \App\Models\Item::factory($numItens)->make()
                );
            });
        });
    }
}
