<?php

namespace App\Livewire\Component;

use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public function render()
    {
        return view('livewire.component.product-card');
    }
}
