<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'path',
        'filename',
        'mime_type',
        'size',
        'photoable_type',
        'photoable_id',
    ];

    public function photoable()
    {
        return $this->morphTo();
    }
}
