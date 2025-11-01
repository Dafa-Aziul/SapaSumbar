<?php

namespace App\Livewire\Homepage;

use App\Models\Complaint; // pastikan model ini ada
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Beranda')]
class Index extends Component
{
    public function render()
    {
        // Ambil semua data complaint terbaru
        $complaints = Complaint::with(['user', 'category'])
            ->latest()
            ->get();
        return view('livewire.homepage.index', [
            'complaints' => $complaints,
        ]);
    }
}
