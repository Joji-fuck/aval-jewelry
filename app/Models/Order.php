<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function users(){
        return $this->belongsTo(User::class);
    }
}
