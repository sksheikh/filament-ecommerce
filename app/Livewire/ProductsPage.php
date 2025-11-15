<?php

namespace App\Livewire;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;

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
    public $sort_by;

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

        if($this->sort_by){
            $productsQuery->orderBy($this->sort_by, 'desc');
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
