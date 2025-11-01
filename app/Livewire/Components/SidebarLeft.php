<?php

namespace App\Livewire\Components;

use Livewire\Component;

class SidebarLeft extends Component
{
    public $activeCategory = 'semua-pengaduan';
    public $showMobileSidebar = false;

    protected $listeners = ['toggleSidebar' => 'toggleMobileSidebar'];

    public function mount()
    {
        // Listen to custom event from navbar
        if (request()->isMethod('get')) {
            $this->dispatch('sidebar-mounted');
        }
    }

    public $categories = [
        [
            'id' => 'semua-pengaduan',
            'label' => 'Semua Pengaduan',
            'icon' => 'list',
        ],
        [
            'id' => 'pungli-premanisme',
            'label' => 'Pungli dan Premanisme',
            'icon' => 'alert',
        ],
        [
            'id' => 'bencana-darurat',
            'label' => 'Bencana Darurat',
            'icon' => 'disaster',
        ],
        [
            'id' => 'kerusakan-fasilitas',
            'label' => 'Kerusakan Fasilitas',
            'icon' => 'building',
        ],
    ];

    public $statistics = [
        [
            'label' => 'Total Pengaduan',
            'value' => '1,234',
            'color' => '#212121',
        ],
        [
            'label' => 'Dalam Proses',
            'value' => '45',
            'color' => '#E53935',
        ],
        [
            'label' => 'Selesai',
            'value' => '1,189',
            'color' => '#4CAF50',
        ],
    ];

    public function selectCategory($categoryId)
    {
        $this->activeCategory = $categoryId;
    }

    public function toggleMobileSidebar()
    {
        $this->showMobileSidebar = !$this->showMobileSidebar;
    }

    public function render()
    {
        return view('livewire.components.sidebar-left');
    }
}
