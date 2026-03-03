<?php

namespace App\Livewire;

use Livewire\Component;

class SuccessPage extends Component
{
    public $order_id;

    public function mount($order)
    {
        $this->order_id = $order;
    }

    public function render()
    {
        $order = \App\Models\Order::with('address')->findOrFail($this->order_id);
        return view('livewire.success-page', [
            'order' => $order
        ]);
    }
}
