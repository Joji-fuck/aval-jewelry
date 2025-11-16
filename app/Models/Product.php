<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'sky',
        'description',
        'price',
        'stock',
        'category_id',
        'is_published',
        'productable_id',
        'productable_type'
    ];

    public function productable(): MorphTo
    {
        return $this->morphTo();
    }
    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function product_images(): HasMany{
        return $this->hasMany(ProductImage::class);
    }
    public function orders(): BelongsToMany{
      return $this->belongsToMany(Order::class);
    }
}
