<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'grand_total',
        'payment_method',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes',
        'transaction_id',
        'payment_phone',
    ];

    protected $casts = [
        'status' => \App\Enums\OrderStatus::class,
        'payment_method' => \App\Enums\PaymentMethod::class,
        'payment_status' => \App\Enums\PaymentStatus::class,
        'shipping_method' => \App\Enums\ShippingMethod::class,
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }
}
