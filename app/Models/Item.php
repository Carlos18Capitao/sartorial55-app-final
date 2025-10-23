<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    protected $fillable = [
        'status',
        'itemable_type',
        'itemable_id',
        'encomenda_id',
        'descricao',
        'quantidade'
    ];
    protected $table = 'items';
    protected $appends = ['tipo'];

    public function encomenda()
    {
        return $this->belongsTo(Encomenda::class, 'encomenda_id');
    }

    public function itemable()
    {
        return $this->morphTo();
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }

    public function getTipoAttribute()
    {
        return class_basename($this->itemable_type);
    }


}
