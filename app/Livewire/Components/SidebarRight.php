<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SidebarRight extends Component
{
    public $showFilterDropdown = false;
    public $showFilterStatusDropdown = false;
    
    public $filterStatus = [
        'diproses' => true,  // Active
        'selesai' => false,  // Inactive
    ];
    
    public $sortBy = 'terbaru'; // 'terbaru' or 'terpopuler'

    public function toggleFilterDropdown()
    {
        $this->showFilterDropdown = !$this->showFilterDropdown;
    }

    public function toggleFilterStatusDropdown()
    {
        $this->showFilterStatusDropdown = !$this->showFilterStatusDropdown;
    }

    public function toggleFilterStatus($status)
    {
        $this->filterStatus[$status] = !$this->filterStatus[$status];
    }

    public function setSortBy($sort)
    {
        $this->sortBy = $sort;
    }

    public function createReport()
    {
        // Handler untuk tombol buat pengaduan
        // Bisa diubah ke redirect atau emit event sesuai kebutuhan
        // return redirect()->route('pengaduan.create');
        $this->dispatch('open-create-modal');
    }

    public function render()
    {
        return view('livewire.components.sidebar-right');
    }
}
