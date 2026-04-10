<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function districts()
    {
        return $this->belongsToMany(District::class, 'delivery_charge_districts');
    }


}
