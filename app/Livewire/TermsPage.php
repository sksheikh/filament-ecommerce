<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('Terms & Conditions | Nafisa Mart')]
class TermsPage extends Component
{
    public function render()
    {
        return view('livewire.terms-page');
    }
}
