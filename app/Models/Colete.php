<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colete extends Model
{
    /** @use HasFactory<\Database\Factories\ColeteFactory> */
    use HasFactory;
protected $fillable = [
    'modelo',
    'costa',
    'acabamento',
];
    public function itens()
    {
        return $this->morphMany(Item::class, 'itemable');
    }
}
