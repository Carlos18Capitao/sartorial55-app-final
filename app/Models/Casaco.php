<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casaco extends Model
{
    /** @use HasFactory<\Database\Factories\CasacoFactory> */
    use HasFactory;
    protected $table = 'casacos';
    protected $fillable = [
        'modelo',
        'lapela',
        'bolsos',
        'forro',
        'botao',
        'manga',
        'costas',
        'acabamento',
        'status'
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
