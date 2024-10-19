<?php

namespace App\Livewire\Pages;

use App\Enums\Layout;
use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('livewire.pages.welcome')->layout(Layout::APP->value);
    }
}
