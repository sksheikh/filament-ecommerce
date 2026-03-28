<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $my_orders = Order::where('customer_id', auth()->guard('customer')->id())
            ->latest()
            ->paginate(10);

        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
        ])
        ->title("My Orders | " . config('app.name'));
    }
}
