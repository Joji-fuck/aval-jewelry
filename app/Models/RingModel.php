<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RingModel extends Model
{
    protected $fillable = ['type', 'name', 'model_path', 'thumbnail'];

    public function orders()
    {
        return $this->hasMany(RingOrder::class);
    }
}
