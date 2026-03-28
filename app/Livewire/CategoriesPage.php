<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::active()->get();

        return view('livewire.categories-page', [
            'categories' => $categories
        ])->title("Our Categories | " . config('app.name'));
    }
}
