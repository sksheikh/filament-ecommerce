<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'order_id',
        'first_name',
        'last_name',
        'phone',
        'street_address',
        'district',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }



    public function district()
    {
        return $this->belongsTo(District::class);
    }



    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
