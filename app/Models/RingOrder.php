<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingOrder extends Model
{
    protected $fillable = [
        'user_id',
        'ring_model_id',
        'material_id',
        'surname',
        'name',
        'patronymic',
        'phone',
        'email',
        'country',
        'city',
        'street',
        'house_number',
        'zip_code',
        'ring_size',
        'comment',
        'status',
        'total',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ringModel()
    {
        return $this->belongsTo(RingModel::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
