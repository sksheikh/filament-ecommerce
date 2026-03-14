<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Component;

#[Title('Checkout | Nafisa Mart')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $division;
    public $district;
    public $area;
    public $zip_code;
    public $payment_method;
    public $notes;

    public $divisions = [];
    public $districts = [];
    public $areas = [];

    public function mount()
    {
        $this->divisions = \App\Models\Division::all();
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

    public function updatedDivision($divisionId)
    {
        $this->districts = \App\Models\District::where('division_id', $divisionId)->get();
        $this->district = null;
        $this->area = null;
        $this->areas = [];
    }

    public function updatedDistrict($districtId)
    {
        $this->areas = \App\Models\Area::where('district_id', $districtId)->get();
        $this->area = null;
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
            'division' => 'required',
            'district' => 'required',
            'area' => 'required',
            'payment_method' => 'required',
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        $order = new \App\Models\Order();
        $order->order_number = \App\Helpers\OrderNumberGenerator::generate();
        $order->customer_id = auth()->guard('customer')->id();
        $order->grand_total = $grand_total;
        $order->payment_method = $this->payment_method;
        $order->payment_status = \App\Enums\PaymentStatus::Pending;
        $order->status = \App\Enums\OrderStatus::Pending;
        $order->currency = 'BDT';
        $order->shipping_amount = 0;
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

        $division_name = \App\Models\Division::find($this->division)?->name;
        $district_name = \App\Models\District::find($this->district)?->name;
        $area_name = \App\Models\Area::find($this->area)?->name;

        $order->address()->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'division' => $division_name,
            'district' => $district_name,
            'area' => $area_name,
            'zip_code' => $this->zip_code,
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
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        return view('livewire.checkout-page',[
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
