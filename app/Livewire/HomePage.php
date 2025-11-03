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
        $categories = Category::active()->limit(4)->get();

        $featuredProducts = Product::query()
            ->featured()
            ->orderBY('id','desc')
            ->limit(4)
            ->get();

        return view('livewire.home-page',[
            'categories' => $categories,
            'featuredProducts' => $featuredProducts
        ]);
    }
}
