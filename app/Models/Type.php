<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function stones(): HasMany{
        return $this->hasMany(Stone::class);
    }
}
