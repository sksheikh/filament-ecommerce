<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Our Categories | Nafisa Mart')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::active()->get();

        return view('livewire.categories-page', [
            'categories' => $categories
        ]);
    }
}
