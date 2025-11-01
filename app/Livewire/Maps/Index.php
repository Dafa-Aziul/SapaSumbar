<?php

namespace App\Livewire\Maps;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Peta Sumatera Barat - Sapa Sumbar')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.maps.index');
    }
}
