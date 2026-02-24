<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'telefone',
    ];

    /**
     * Get the user that owns the cliente.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the encomendas for the cliente.
     */
    public function encomendas(): HasMany
    {
        return $this->hasMany(Encomenda::class);
    }

    /**
     * Get the default medidas for the cliente.
     */
    public function medidas(): HasOne
    {
        return $this->hasOne(ClienteMedidas::class);
    }
}
