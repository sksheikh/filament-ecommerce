<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

// #[Title("Categories | " )]
class CategoriesPage extends Component
{

    public function render()
    {
        $categories = Category::active()->limit(4)->get();
        return view('livewire.categories-page',[
            'categories' => $categories
        ])
        ->title("Categories | ". config('app.name'));
    }
}
