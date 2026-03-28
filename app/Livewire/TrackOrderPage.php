<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Track Your Order | Nafisa Mart')]
class TrackOrderPage extends Component
{
    public $order_number;
    public $phone;
    public $order = null;
    public $searched = false;

    public function track()
    {
        $this->validate([
            'order_number' => 'required|min:5',
            'phone' => 'required|min:11',
        ]);

        $this->order = \App\Models\Order::query()
            ->with(['items.product', 'address'])
            ->where('order_number', trim($this->order_number))
            ->whereHas('address', function ($query) {
                $query->where('phone', trim($this->phone));
            })
            ->first();

        $this->searched = true;
    }

    public function render()
    {
        return view('livewire.track-order-page');
    }
}
