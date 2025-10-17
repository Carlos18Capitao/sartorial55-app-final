<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Camisa extends Model
{
    /** @use HasFactory<\Database\Factories\CamisaFactory> */
    use HasFactory;

    protected $fillabel = [
        'colarinho',
        'punho',
        'pincas',
        'carcela',
        'acabamento',
    ];

    public function itens()
    {
        return $this->morphMany(Item::class, 'itemable');
    }
}
