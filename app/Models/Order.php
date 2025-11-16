<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'status',
        'user_id',
        'surname',
        'name',
        'patronymic',
        'phone',
        'country',
        'city',
        'street',
        'house_number',
        'zip_code',
        'total_price',
        'comment'
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function products(): BelongsToMany{
        return $this->belongsToMany(Product::class);
    }

}
