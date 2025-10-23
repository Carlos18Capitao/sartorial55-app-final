<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\Cliente;
use App\Models\Item;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed photos for clientes
        $clientes = Cliente::all();
        foreach ($clientes as $cliente) {
            Photo::create([
                'path' => 'storage/photos/clientes/' . $cliente->id . '/profile.jpg',
                'filename' => 'profile.jpg',
                'mime_type' => 'image/jpeg',
                'size' => 102400, // 100KB
                'photoable_type' => Cliente::class,
                'photoable_id' => $cliente->id,
            ]);
        }

        // Seed photos for items
        $items = Item::all();
        foreach ($items as $item) {
            Photo::create([
                'path' => 'storage/photos/items/' . $item->id . '/item.jpg',
                'filename' => 'item.jpg',
                'mime_type' => 'image/jpeg',
                'size' => 51200, // 50KB
                'photoable_type' => Item::class,
                'photoable_id' => $item->id,
            ]);
        }
    }
}
