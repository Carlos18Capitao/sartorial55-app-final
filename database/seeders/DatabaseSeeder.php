<?php

namespace Database\Seeders;

use App\Models\Cliente;
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


        // Criar 1 clientesa
        //Cliente::factory(1)->create();

        // Seed encomendas com itens e medidas
        $this->call([
            EncomendaSeeder::class,
        ]);
    }
}
