<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = [
        'nome',
        'telefone',
        'email'
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function encomendas()
    {
        return $this->hasMany(Encomenda::class, 'cliente_id');
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}
