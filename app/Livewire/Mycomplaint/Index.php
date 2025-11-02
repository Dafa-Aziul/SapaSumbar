<?php

namespace App\Livewire\Mycomplaint;

use Livewire\Attributes\Title;
use Livewire\Component;
#[Title('Daftar Pengaduan Saya')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.mycomplaint.index');
    }
}
