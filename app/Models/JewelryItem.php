<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class JewelryItem extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];
    public function stones(): BelongsToMany{
        return $this->belongsToMany(Stone::class);
    }
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }
    public function products(): MorphMany
    {
        return $this->morphMany(Product::class, 'productable');
    }
}
