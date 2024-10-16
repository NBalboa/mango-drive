<?php

namespace App\Livewire;

use Livewire\Component;

class Nav extends Component
{

    public $open = false;

    public function showMenu()
    {
        $this->open = !$this->open;
    }
    public function render()
    {
        return view('livewire.nav');
    }
}
