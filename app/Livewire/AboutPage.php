<?php

namespace App\Livewire;

use App\Helpers\CmsHelper;
use Livewire\Component;
use Livewire\Attributes\Title;

class AboutPage extends Component
{
    public function render()
    {
        return view('livewire.about-page', [
            'cms' => CmsHelper::all(),
        ])->title("About Us | " . config('app.name'));
    }
}
