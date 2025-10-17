<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calca extends Model
{
    /** @use HasFactory<\Database\Factories\CalcaFactory> */
    use HasFactory;
    protected $fillable = [
        'modelo',
        'cos',
        'vinco',
        'bainha',
        'bolsos',
        'presilhas',
        'botoes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function itens()
    {
        return $this->morphMany(Item::class, 'itemable');
    }
}
