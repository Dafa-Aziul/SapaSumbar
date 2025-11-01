<?php

namespace App\Livewire\Components;

use App\Models\Category;
use App\Models\Complaint;
use Livewire\Component;

class SidebarLeft extends Component
{
    public $activeCategory = 'semua-pengaduan';
    public $showMobileSidebar = false;
    public $categories = [];
    public $statistics = [];

    protected $listeners = ['toggleSidebar' => 'toggleMobileSidebar'];

    public function mount()
    {
        // Load categories from database
        $this->loadCategories();

        // Load statistics from database
        $this->loadStatistics();

        // Listen to custom event from navbar
        if (request()->isMethod('get')) {
            $this->dispatch('sidebar-mounted');
        }
    }

    private function loadCategories()
    {
        // Add "Semua Pengaduan" as first item
        $this->categories = [
            [
                'id' => 'semua-pengaduan',
                'label' => 'Semua Pengaduan',
                'icon' => 'list',
            ],
        ];

        // Fetch categories from database
        $dbCategories = Category::all();

        foreach ($dbCategories as $category) {
            // Map icon based on category name or provide default
            $icon = $this->getIconForCategory($category->name);

            $this->categories[] = [
                'id' => $category->id,
                'label' => $category->name,
                'description' => $category->description,
                'icon' => $icon,
            ];
        }
    }

    private function getIconForCategory($categoryName)
    {
        $categoryLower = strtolower($categoryName);

        // Map category names to icons
        $iconMap = [
            'pungli' => 'alert',
            'premanisme' => 'alert',
            'bencana' => 'disaster',
            'darurat' => 'disaster',
            'kerusakan' => 'building',
            'fasilitas' => 'building',
        ];

        // Check if any keyword matches
        foreach ($iconMap as $keyword => $icon) {
            if (strpos($categoryLower, $keyword) !== false) {
                return $icon;
            }
        }

        // Default to 'list' icon if no match
        return 'list';
    }

    private function loadStatistics()
    {
        $totalComplaints = Complaint::count();
        $inProgressComplaints = Complaint::where('status', 'diproses')->count();
        $completedComplaints = Complaint::where('status', 'selesai')->count();

        $this->statistics = [
            [
                'label' => 'Total Pengaduan',
                'value' => number_format($totalComplaints),
                'color' => '#212121',
            ],
            [
                'label' => 'Dalam Proses',
                'value' => number_format($inProgressComplaints),
                'color' => '#E53935',
            ],
            [
                'label' => 'Selesai',
                'value' => number_format($completedComplaints),
                'color' => '#4CAF50',
            ],
        ];
    }

    public function selectCategory($categoryId)
    {
        $this->activeCategory = $categoryId;
        // Dispatch event to filter complaints in homepage
        $this->dispatch('category-selected', categoryId: $categoryId);
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
