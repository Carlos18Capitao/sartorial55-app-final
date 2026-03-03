<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClienteMedidas extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteMedidasFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cliente_id',
        // Camisa
        'colarinho', 'ombro_ombro', 'peito', 'cintura', 'anca', 'bicep',
        'comprimento_manga_direita', 'comprimento_manga_esquerda', 'comprimento_manga_curta',
        'punho_esquerdo', 'punho_direito', 'comprimento_camisa',
        // Casaco
        'base', 'distancia_ombro_botao', 'comprimento_manga_casaco', 'bicep_casaco',
        'boca_manga', 'meia_cinta', 'meio_ombro', 'meia_costa',
        'comprimento_costa', 'comprimento_frente', 'racha_lateral_casaco',
        // Colete
        'tamanho_colete', 'ombro_botao_colete', 'comprimento_frente_colete',
        'comprimento_costa_colete', 'meia_cinta_colete',
        // Calça
        'tamanho_calca', 'cintura_calca', 'anca_calca', 'coxa', 'joelho',
        'comprimento_calca', 'bainha', 'gancho_frente', 'gancho_atras',
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
        'comprimento_camisa' => 'decimal:2',
        'base' => 'decimal:2',
        'distancia_ombro_botao' => 'decimal:2',
        'comprimento_manga_casaco' => 'decimal:2',
        'bicep_casaco' => 'decimal:2',
        'boca_manga' => 'decimal:2',
        'meia_cinta' => 'decimal:2',
        'meio_ombro' => 'decimal:2',
        'meia_costa' => 'decimal:2',
        'comprimento_costa' => 'decimal:2',
        'comprimento_frente' => 'decimal:2',
        'racha_lateral_casaco' => 'decimal:2',
        'ombro_botao_colete' => 'decimal:2',
        'comprimento_frente_colete' => 'decimal:2',
        'comprimento_costa_colete' => 'decimal:2',
        'meia_cinta_colete' => 'decimal:2',
        'cintura_calca' => 'decimal:2',
        'anca_calca' => 'decimal:2',
        'coxa' => 'decimal:2',
        'joelho' => 'decimal:2',
        'comprimento_calca' => 'decimal:2',
        'bainha' => 'decimal:2',
        'gancho_frente' => 'decimal:2',
        'gancho_atras' => 'decimal:2',
    ];

    /**
     * Get the cliente that owns the medidas.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}

