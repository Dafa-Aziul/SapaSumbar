<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public $searchQuery = '';
    public $showMobileMenu = false;
    public $showMobileSearch = false;

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
