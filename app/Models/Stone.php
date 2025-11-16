<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Stone extends Model
{
    protected $fillable = [
        'name',
        'internal_sku',
        'slug',
        'description',
        'type_id',
        'cut_id',
        'color_id',
        'weight',
        'price',
        'stock'
    ];
    public function type(): BelongsTo{
        return $this->belongsTo(Type::class);
    }
    public function cut(): BelongsTo{
        return $this->belongsTo(Cut::class);
    }
    public function color(): BelongsTo{
        return $this->belongsTo(Color::class);
    }
    public function jewelry_items(): BelongsToMany{
        return $this->belongsToMany(JewelryItem::class);
    }
    public function products(): MorphMany
    {
        return $this->morphMany(Product::class, 'productable');
    }
}
