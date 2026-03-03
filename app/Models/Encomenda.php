<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encomenda extends Model
{
    /** @use HasFactory<\Database\Factories\EncomendaFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        'data_encomenda',
        'estado',
        'total',
        'observacoes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_encomenda' => 'date',
        'total' => 'decimal:2',
    ];

    /**
     * Get the cliente that owns the encomenda.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Get the itens for the encomenda.
     */
    public function itens(): HasMany
    {
        return $this->hasMany(ItemEncomenda::class);
    }
}

