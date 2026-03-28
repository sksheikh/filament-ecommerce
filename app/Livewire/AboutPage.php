<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('About Us | Nafisa Mart')]
class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.about-page');
    }
}
