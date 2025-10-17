<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sapato extends Model
{
    /** @use HasFactory<\Database\Factories\SapatoFactory> */
    use HasFactory;

    protected $fillable = [
        'modelo',
        'acabamento',
    ];

    public function itens()
    {
        return $this->morphMany(Item::class, 'itemable');
    }
}
