<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fato extends Model
{
    /** @use HasFactory<\Database\Factories\FatoFactory> */
    use HasFactory;

protected $fillable = [
    'casaco_id',
    'colete_id',
    'calca_id',
    'acabamento',
];

    public function itens()
    {
        return $this->morphMany(Item::class, 'itemable');
    }

    public function casaco(){
        return $this->hasOne(Casaco::class);
    }
    public function calca(){
        return $this->hasOne(Calca::class);
    }
    public function colete(){
        return $this->hasOne(Colete::class);
    }
}
