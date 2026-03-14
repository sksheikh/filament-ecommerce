<?php

namespace App\Helpers;

use App\Models\Order;

class OrderNumberGenerator
{
    /**
     * Generate a unique order number.
     * Format: ORD-YYYYMMDD-XXXX
     *
     * @return string
     */
    public static function generate(): string
    {
        $date = now()->format('Ymd');
        $prefix = 'ORD-' . $date . '-';
        
        // Get the last order number for today
        $lastOrder = Order::where('order_number', 'like', $prefix . '%')
            ->orderBy('order_number', 'desc')
            ->first();

        if ($lastOrder) {
            // Extract the last 4 digits and increment
            $lastIndex = (int) substr($lastOrder->order_number, -4);
            $newIndex = str_pad((string)($lastIndex + 1), 4, '0', STR_PAD_LEFT);
        } else {
            $newIndex = '0001';
        }

        return $prefix . $newIndex;
    }
}
