<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $fillable = [
        'encomenda_id',
        'casaco_id',
        'quantidade',
        'preco_unitario',
        'total'
    ];
    protected $table = 'itens_encomenda';

    public function encomenda()
    {
        return $this->belongsTo(Encomenda::class, 'encomenda_id');
    }

    public function itemable()
    {
        return $this->morphTo();
    }
    

}
