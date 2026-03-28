<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Title;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.about-page')
            ->title("About Us | " . config('app.name'));
    }
}
