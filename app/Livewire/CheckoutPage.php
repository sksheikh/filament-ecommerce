<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Component;

class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $district;
    public $payment_method;
    public $notes;
    public $shipping_amount = 0;

    public $districts = [];

    public function mount()
    {
        $this->districts = \App\Models\District::all();
        
        $shippingInfo = \App\Helpers\ShippingChargeManagement::getShippingInfoFromCookie();
        if ($shippingInfo) {
            $this->district = $shippingInfo['district_id'] ?? null;
            $this->shipping_amount = $shippingInfo['amount'] ?? 0;
        }

        $cart_items = CartManagement::getCartItemsFromCookie();
        if(empty($cart_items)) {
            return redirect()->route('products');
        }

        if (auth()->guard('customer')->check()) {
            $customer = auth()->guard('customer')->user();
            
            // Split name into first and last name for the address form if possible
            $nameParts = explode(' ', $customer->name, 2);
            $this->first_name = $nameParts[0] ?? '';
            $this->last_name = $nameParts[1] ?? '';
            
            $this->phone = $customer->phone;
        }
    }

    public function updatedDistrict($districtId)
    {
        $this->shipping_amount = \App\Helpers\ShippingChargeManagement::getShippingCharge($districtId);
    }

    protected function calculateShipping()
    {
        $this->shipping_amount = \App\Helpers\ShippingChargeManagement::getShippingCharge($this->district);
    }

    public function placeOrder()
    {
        if (!auth()->guard('customer')->check()) {
            return redirect()->route('login');
        }

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'district' => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();
        $subtotal = CartManagement::calculateGrandTotal($cart_items);
        $grand_total = $subtotal + $this->shipping_amount;

        $order = new \App\Models\Order();
        $order->order_number = \App\Helpers\OrderNumberGenerator::generate();
        $order->customer_id = auth()->guard('customer')->id();
        $order->grand_total = $grand_total;
        $order->payment_method = $this->payment_method;
        $order->payment_status = \App\Enums\PaymentStatus::Pending;
        $order->status = \App\Enums\OrderStatus::Pending;
        $order->currency = 'BDT';
        $order->shipping_amount = $this->shipping_amount;
        // $order->shipping_method = \App\Enums\ShippingMethod::Standard;
        $order->notes = $this->notes;
        $order->save();

        foreach ($cart_items as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['total_amount'],
            ]);
        }

        $district_name = \App\Models\District::find($this->district)?->name;

        $order->address()->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'district' => $district_name,
        ]);

        CartManagement::clearCartItems();

        if ($this->payment_method == 'bkash') {
            return redirect()->route('checkout.payment', $order->id);
        }

        return redirect()->route('success', $order->id);
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $subtotal = CartManagement::calculateGrandTotal($cart_items);
        $grand_total = $subtotal + $this->shipping_amount;

        return view('livewire.checkout-page',[
            'cart_items' => $cart_items,
            'subtotal' => $subtotal,
            'grand_total' => $grand_total,
            'shipping_amount' => $this->shipping_amount,
        ])
        ->title("Checkout | " . config('app.name'));
    }
}
