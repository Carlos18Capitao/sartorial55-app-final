<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Encomenda;
use App\Models\Item;
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
        Cliente::factory(10)->create()->each(function ($cliente) {
            // Cada cliente tem pelo menos 1 encomenda
            $numEncomendas = rand(1, 3);
            $cliente->encomendas()->saveMany(
                Encomenda::factory($numEncomendas)->make()
            )->each(function ($encomenda) {
                // Cada encomenda tem pelo menos 1 item
                $numItens = rand(1, 5);
                $encomenda->itens()->saveMany(
                    Item::factory($numItens)->make()
                );
            });
        });
    }
}
