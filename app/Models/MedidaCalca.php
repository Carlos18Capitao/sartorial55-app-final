<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class MedidaCalca extends Model
{
    /** @use HasFactory<\Database\Factories\MedidaCalcaFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tamanho',
        'cintura',
        'anca',
        'coxa',
        'joelho',
        'comprimento',
        'bainha',
        'gancho_frente',
        'gancho_atras',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'cintura' => 'decimal:2',
        'anca' => 'decimal:2',
        'coxa' => 'decimal:2',
        'joelho' => 'decimal:2',
        'comprimento' => 'decimal:2',
        'bainha' => 'decimal:2',
        'gancho_frente' => 'decimal:2',
        'gancho_atras' => 'decimal:2',
    ];

    /**
     * Get the item_encomenda associated with this medida.
     */
    public function itemEncomenda(): MorphOne
    {
        return $this->morphOne(ItemEncomenda::class, 'medida');
    }
}

