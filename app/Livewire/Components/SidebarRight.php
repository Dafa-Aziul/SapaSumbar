<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SidebarRight extends Component
{
    public $showFilterDropdown = false;
    public $showFilterStatusDropdown = false;

    public $filterStatus = [
        'diproses' => true,  // Active
        'selesai'  => false, // Inactive
    ];

    public $sortBy = 'terbaru'; // 'terbaru' or 'terpopuler'

    /** 🔄 Toggle Filter Visibility */
    public function toggleFilterDropdown()
    {
        $this->showFilterDropdown = !$this->showFilterDropdown;
    }

    public function toggleFilterStatusDropdown()
    {
        $this->showFilterStatusDropdown = !$this->showFilterStatusDropdown;
    }

    /** ✅ Ubah status filter */
    public function toggleFilterStatus($status)
    {
        if (array_key_exists($status, $this->filterStatus)) {
            $this->filterStatus[$status] = !$this->filterStatus[$status];
        }
    }

    /** 🔽 Ganti urutan daftar laporan */
    public function setSortBy($sort)
    {
        $this->sortBy = $sort;
        $this->dispatch('sortChanged', sort: $sort);
    }

    /** 🟥 Tombol “Buat Pengaduan” → buka modal di komponen lain */
    public function createReport()
    {
        // Event Livewire ke komponen lain
        $this->dispatch('openCreateComplaintModal');

        // Event ke browser (AlpineJS)
        $this->dispatch('open-create-complaint-modal', [], true);
    }



    public function render()
    {
        return view('livewire.components.sidebar-right');
    }
}
