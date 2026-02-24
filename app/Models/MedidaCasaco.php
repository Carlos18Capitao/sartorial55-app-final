<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MedidaCasaco extends Model
{
    /** @use HasFactory<\Database\Factories\MedidaCasacoFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'base',
        'distancia_ombro_botao',
        'comprimento_manga',
        'bicep',
        'boca_manga',
        'meia_cinta',
        'meio_ombro',
        'meia_costa',
        'comprimento_costa',
        'comprimento_frente',
        'racha_lateral',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'base' => 'decimal:2',
        'distancia_ombro_botao' => 'decimal:2',
        'comprimento_manga' => 'decimal:2',
        'bicep' => 'decimal:2',
        'boca_manga' => 'decimal:2',
        'meia_cinta' => 'decimal:2',
        'meio_ombro' => 'decimal:2',
        'meia_costa' => 'decimal:2',
        'comprimento_costa' => 'decimal:2',
        'comprimento_frente' => 'decimal:2',
        'racha_lateral' => 'decimal:2',
    ];

    /**
     * Get the item_encomenda associated with this medida.
     */
    public function itemEncomenda(): MorphOne
    {
        return $this->morphOne(ItemEncomenda::class, 'medida');
    }
}

