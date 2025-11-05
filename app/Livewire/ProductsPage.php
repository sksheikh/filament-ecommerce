<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Products | Nafisa Mart')]
class ProductsPage extends Component
{

    public function render()
    {
        $products = Product::query()
            ->active()
            ->paginate(6);

        $categories = Category::query()
            ->active()
            ->orderBy('name', 'asc')
            ->get();

        $brands = Brand::query()
            ->active()
            ->orderBy('name','asc')
            ->get();

        return view('livewire.products-page',[
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
