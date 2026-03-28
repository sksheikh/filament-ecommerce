<?php

namespace App\Livewire;

use Livewire\Component;

class TermsPage extends Component
{
    public function render()
    {
        return view('livewire.terms-page')
            ->title("Terms & Conditions | " . config('app.name'));
    }
}
