<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product Details | Nafisa Mart')]
class ProductDetailPage extends Component
{
    public $slug;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function increaseQuantity()
    {
        $this->quantity++;
    }

    public function decreaseQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart($productId)
    {
        $total_count = \App\Helpers\CartManagement::addItemToCart($productId);
        $this->dispatch('update-cart-item', total_count: $total_count);
        $this->dispatch('toast', [
            'message' => 'Product added to cart!',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->firstOrFail();

        return view('livewire.product-detail-page',[
            'product' => $product
        ]);
    }
}
