<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Order Details - Nafisa Mart')]
class MyOrderDetailPage extends Component
{
    public $order_id;

    public function mount($order)
    {
        $this->order_id = $order;
    }

    public function render()
    {
        $order_items = OrderItem::with('product')->where('order_id', $this->order_id)->get();
        $order = Order::with('address')->findOrFail($this->order_id);

        return view('livewire.my-order-detail-page', [
            'order_items' => $order_items,
            'order' => $order,
        ]);
    }
}
