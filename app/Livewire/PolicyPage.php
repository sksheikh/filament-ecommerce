<?php

namespace App\Livewire;

use Livewire\Component;

use Livewire\Attributes\Title;

#[Title('Our Policy | Nafisa Mart')]
class PolicyPage extends Component
{
    public function render()
    {
        return view('livewire.policy-page');
    }
}
