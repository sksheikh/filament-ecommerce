<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'district_id',
        'name',
        'bn_name',
        'url',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function deliveryCharges()
    {
        return $this->belongsToMany(DeliveryCharge::class, 'delivery_charge_areas');
    }
}
