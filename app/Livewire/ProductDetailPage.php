<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

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

    public function addToCart($productId, $qty = null)
    {
        $quantity = $qty ?? $this->quantity;
        $total_count = \App\Helpers\CartManagement::addItemToCartWithQty($productId, $quantity);
        $this->dispatch('update-cart-item', total_count: $total_count)->to(\App\Livewire\Partials\Navbar::class);
        $this->dispatch('toast', [
            'message' => 'Product added to cart!',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->active()->firstOrFail();
        
        $relatedProducts = Product::query()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->limit(4)
            ->get();

        return view('livewire.product-detail-page', [
            'product' => $product,
            'relatedProducts' => $relatedProducts
        ])
        ->title($product->name . " | " . config('app.name'));
    }
}
