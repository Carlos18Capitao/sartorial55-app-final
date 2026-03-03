<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\ClienteMedidas;

class MedidaColete extends Model
{
    /** @use HasFactory<\Database\Factories\MedidaColeteFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tamanho',
        'ombro_botao',
        'comprimento_frente',
        'comprimento_costa',
        'meia_cinta',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'ombro_botao' => 'decimal:2',
        'comprimento_frente' => 'decimal:2',
        'comprimento_costa' => 'decimal:2',
        'meia_cinta' => 'decimal:2',
    ];

    /**
     * Get the item_encomenda associated with this medida.
     */
    public function itemEncomenda(): MorphOne
    {
        return $this->morphOne(ItemEncomenda::class, 'medida');
    }

    /**
     * Create a MedidaColete from default ClienteMedidas.
     */
    public static function createFromDefault(ClienteMedidas $defaultMedidas): self
    {
        return self::create([
            'tamanho' => $defaultMedidas->tamanho_colete,
            'ombro_botao' => $defaultMedidas->ombro_botao_colete,
            'comprimento_frente' => $defaultMedidas->comprimento_frente_colete,
            'comprimento_costa' => $defaultMedidas->comprimento_costa_colete,
            'meia_cinta' => $defaultMedidas->meia_cinta_colete,
        ]);
    }
}

