<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderPrintController extends Controller
{
    public function invoice(Order $order)
    {
        $order->load(['customer', 'items.product', 'address']);
        return view('admin.orders.invoice', compact('order'));
    }

    public function deliverySlip(Order $order)
    {
        $order->load(['customer', 'items.product', 'address']);
        return view('admin.orders.delivery-slip', compact('order'));
    }
}
