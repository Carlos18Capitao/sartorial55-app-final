<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use App\Models\MedidaCamisa;
use App\Models\MedidaColete;

class ItemEncomenda extends Model
{
    /** @use HasFactory<\Database\Factories\ItemEncomendaFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'encomenda_id',
        'tipo',
        'foto',
        'estado',
        'observacoes',
        'data_envio',
        'data_previsao',
        'medida_id',
        'medida_type',
        'cliente_medidas_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'data_envio' => 'date',
        'data_previsao' => 'date',
    ];

    /**
     * Get the encomenda that owns the item.
     */
    public function encomenda(): BelongsTo
    {
        return $this->belongsTo(Encomenda::class);
    }

    /**
     * Get the medida related to the item (polymorphic).
     */
    public function medida(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the default cliente medidas.
     */
    public function clienteMedidas(): BelongsTo
    {
        return $this->belongsTo(ClienteMedidas::class, 'cliente_medidas_id');
    }

    /**
     * Create the medida from default ClienteMedidas.
     */
    public function createMedidaFromDefault(): ?self
    {
        if (!$this->cliente_medidas_id || !$this->tipo) {
            return null;
        }

        $defaultMedidas = ClienteMedidas::find($this->cliente_medidas_id);

        if (!$defaultMedidas) {
            return null;
        }

        $medida = null;

        switch ($this->tipo) {
            case 'camisa':
                $medida = MedidaCamisa::createFromDefault($defaultMedidas);
                break;
            case 'colete':
                $medida = MedidaColete::createFromDefault($defaultMedidas);
                break;
            // Add other types as needed: casaco, calca, etc.
        }

        if ($medida) {
            $this->update([
                'medida_id' => $medida->id,
                'medida_type' => get_class($medida),
            ]);
        }

        return $this;
    }
}

