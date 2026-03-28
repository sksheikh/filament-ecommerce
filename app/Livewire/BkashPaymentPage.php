<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;


class BkashPaymentPage extends Component
{
    public $order_id;
    public $payment_phone;
    public $payment_amount;
    public $transaction_id;

    public function mount($order)
    {
        $this->order_id = $order;
        $orderRecord = Order::findOrFail($this->order_id);
        
        // Ensure the order belongs to the customer
        if ($orderRecord->customer_id !== auth()->guard('customer')->id()) {
            abort(403);
        }

        // If already paid or not bkash, redirect
        if ($orderRecord->payment_status === \App\Enums\PaymentStatus::Paid || $orderRecord->payment_method->value !== 'bkash') {
            return redirect()->route('success', $this->order_id);
        }

        $this->payment_amount = $orderRecord->grand_total;
    }

    public function completePayment()
    {
        $this->validate([
            'payment_phone' => 'required|numeric|digits:11',
            'payment_amount' => 'required|numeric',
            'transaction_id' => 'required|string|min:8',
        ]);

        $order = Order::findOrFail($this->order_id);
        $order->update([
            'payment_phone' => $this->payment_phone,
            'transaction_id' => $this->transaction_id,
            'payment_status' => \App\Enums\PaymentStatus::Paid,
        ]);

        return redirect()->route('success', $this->order_id);
    }

    public function render()
    {
        $order = Order::findOrFail($this->order_id);
        $bkash_number = \App\Models\Setting::where('key', 'bkash_number')->first()?->value ?? '01700000000';
        
        return view('livewire.bkash-payment-page', [
            'order' => $order,
            'bkash_number' => $bkash_number
        ])
        ->title("bKash Payment | " . config('app.name'));
    }
}
