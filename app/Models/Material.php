<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];
    public function jewelry_items(): HasMany
    {
        return $this->hasMany(JewelryItem::class);
    }
}
