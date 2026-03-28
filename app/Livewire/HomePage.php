<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title("Home Page | Nafisa Mart")]
class HomePage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->limit(6)->get();
        $brands = \App\Models\Brand::where('is_active', true)->orderBy('name')->get();

        $featuredProducts = Product::query()
            ->where('is_featured', true)
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        $bestSellingProducts = Product::query()
            ->where('is_active', true)
            ->inRandomOrder() // Fallback to random if no sales data yet
            ->limit(4)
            ->get();

        return view('livewire.home-page', [
            'categories' => $categories,
            'brands' => $brands,
            'featuredProducts' => $featuredProducts,
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }
}
