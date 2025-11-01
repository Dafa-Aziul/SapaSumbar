<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class MyComplaintList extends Component
{
    public $complaints;

    public function mount()
    {
        // Ambil semua pengaduan user login beserta relasinya
        $this->complaints = Complaint::with([
            'category',
            'media',
            'votes',
            'responses',
            'progress',
            'user'
        ])
        ->where('user_id', Auth::id())
        ->latest()
        ->get();
    }

    public function render()
    {
        return view('livewire.components.my-complaint-list', [
            'complaints' => $this->complaints,
        ]);
    }
}
