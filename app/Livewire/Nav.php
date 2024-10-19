<?php

namespace App\Livewire;

use Livewire\Component;

class Nav extends Component
{

    public bool $open = false;

    public array $LINKS =
    [
        [
            'to' => '/',
            'active' => false,
            'name' => 'Home'
        ],
        [
            'to' => '/dishes',
            'active' => false,
            'name' => 'Dishes'
        ],
        [
            'to' => '/menus',
            'active' => false,
            'name' => 'Menus'
        ],
        [
            'to' => '/register',
            'active' => false,
            'name' => 'Register'
        ],
    ];

    public function mount()
    {
        foreach ($this->LINKS as $index => $LINK) {
            $this->LINKS[$index]['active'] = $this->active($LINK['to']);
        }
    }
    public function showMenu()
    {
        $this->open = !$this->open;
    }

    public function active($path)
    {
        $currentPath = request()->path();
        return $currentPath == $path;
    }

    public function render()
    {
        return view('livewire.nav');
    }
}
