<?php

namespace App\Livewire\Maps;

use App\Models\Complaint;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Peta Pengaduan')]
class Index extends Component
{
    public $complaints = [];

    public function mount()
    {
        $this->loadComplaints();
    }

    public function loadComplaints()
    {
        $this->complaints = Complaint::with(['user', 'category'])
            ->whereNotNull('location')
            ->where('status', '!=', 'resolved')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.maps.index');
    }
}
