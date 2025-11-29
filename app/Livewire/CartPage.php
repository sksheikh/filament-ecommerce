<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;

#[Title('Cart | Nafisa Mart')]
class CartPage extends Component
{
    public $cart_items = [];
    public $grand_total = 0;

    public function mount()
    {
        $this->cart_items = \App\Helpers\CartManagement::getCartItemsFromCookie();
        // dd( $this->cart_items);
        $this->grand_total = \App\Helpers\CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function removeItem($productId)
    {
        $this->cart_items = CartManagement::removeCartItems($productId);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
        $this->dispatch('update-cart-item', total_count: count($this->cart_items));
        $this->dispatch('toast', [
            'message' => 'Product removed from cart!',
            'icon' => 'success'
        ]);
    }

    public function increaseQuantity($productId)
    {
        $this->cart_items = CartManagement::incrementQuantityToCartItem($productId);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function decreaseQuantity($productId)
    {
        $this->cart_items = CartManagement::decrementQuantityToCartItem($productId);
        $this->grand_total = CartManagement::calculateGrandTotal($this->cart_items);
    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
