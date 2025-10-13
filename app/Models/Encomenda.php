<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    /** @use HasFactory<\Database\Factories\EncomendaFactory> */
    use HasFactory;
    protected $fillable = [
        'cliente_id',
        'data_entrega',
        'status',
        'observacoes'
    ];
    protected $table = 'encomendas';
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function itens()
    {
        return $this->hasMany(Item::class, 'encomenda_id');
    }
}
