<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\ClienteMedidas;

class MedidaCamisa extends Model
{
    /** @use HasFactory<\Database\Factories\MedidaCamisaFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'colarinho',
        'ombro_ombro',
        'peito',
        'cintura',
        'anca',
        'bicep',
        'comprimento_manga_direita',
        'comprimento_manga_esquerda',
        'comprimento_manga_curta',
        'punho_esquerdo',
        'punho_direito',
        'comprimento',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'colarinho' => 'decimal:2',
        'ombro_ombro' => 'decimal:2',
        'peito' => 'decimal:2',
        'cintura' => 'decimal:2',
        'anca' => 'decimal:2',
        'bicep' => 'decimal:2',
        'comprimento_manga_direita' => 'decimal:2',
        'comprimento_manga_esquerda' => 'decimal:2',
        'comprimento_manga_curta' => 'decimal:2',
        'punho_esquerdo' => 'decimal:2',
        'punho_direito' => 'decimal:2',
        'comprimento' => 'decimal:2',
    ];

    /**
     * Get the item_encomenda associated with this medida.
     */
    public function itemEncomenda(): MorphOne
    {
        return $this->morphOne(ItemEncomenda::class, 'medida');
    }

    /**
     * Create a MedidaCamisa from default ClienteMedidas.
     */
    public static function createFromDefault(ClienteMedidas $defaultMedidas): self
    {
        return self::create([
            'colarinho' => $defaultMedidas->colarinho,
            'ombro_ombro' => $defaultMedidas->ombro_ombro,
            'peito' => $defaultMedidas->peito,
            'cintura' => $defaultMedidas->cintura,
            'anca' => $defaultMedidas->anca,
            'bicep' => $defaultMedidas->bicep,
            'comprimento_manga_direita' => $defaultMedidas->comprimento_manga_direita,
            'comprimento_manga_esquerda' => $defaultMedidas->comprimento_manga_esquerda,
            'comprimento_manga_curta' => $defaultMedidas->comprimento_manga_curta,
            'punho_esquerdo' => $defaultMedidas->punho_esquerdo,
            'punho_direito' => $defaultMedidas->punho_direito,
            'comprimento' => $defaultMedidas->comprimento_camisa,
        ]);
    }
}

