<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encomenda extends Model
{
    /** @use HasFactory<\Database\Factories\EncomendaFactory> */
    use HasFactory;
    protected $fillable = [
        'numero',
        'data',
        'status',
        'observacao',
        'cliente_id'
    ];
    protected $table = 'encomendas';

    public function getDataAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('d/m/Y') : null;
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function itens()
    {
        return $this->hasMany(Item::class, 'encomenda_id');
    }
}
