<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;


#[Title('Products | Nafisa Mart')]
class ProductsPage extends Component
{

    #[Url()]
    public $selected_categories = [];

    #[Url()]
    public $selected_brands = [];

    #[Url()]
    public $isFeatured;

    #[Url()]
    public $on_sale;

    #[Url()]
    public $price_range = 3000;

    #[Url()]
    public $sort = "latest";

    public function addToCart($productId){
        $total_count = CartManagement::addItemToCart($productId);
        $this->dispatch('update-cart-item', total_count: $total_count)->to(Navbar::class);
        // $this->alert('success', 'Product added!');
        $this->dispatch('toast', [
            'message' => 'Product added to cart!',
            'icon' => 'success'
        ]);

    }

    public function render()
    {
        $productsQuery = Product::query()
            ->active();

        if(!empty($this->selected_categories)){
            $productsQuery->whereIn('category_id', $this->selected_categories);
        }

        if(!empty($this->selected_brands)){
            $productsQuery->whereIn('brand_id', $this->selected_brands);
        }

        if($this->isFeatured){
            $productsQuery->where('is_featured', 1);
        }

        if($this->on_sale){
           $productsQuery->where('on_sale', 1);
        }

        if($this->price_range){
            $productsQuery->whereBetween('price', [0, $this->price_range]);
        }

        if($this->sort == 'latest'){
            $productsQuery->latest();
        }

        if($this->sort == 'price'){
            $productsQuery->orderBy('price');
        }

        $products = $productsQuery->paginate(9);

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
