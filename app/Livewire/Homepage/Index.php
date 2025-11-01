<?php

namespace App\Livewire\Homepage;

use App\Models\Complaint; // pastikan model ini ada
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Beranda')]
class Index extends Component
{
    public $selectedCategory = 'semua-pengaduan';

    protected $listeners = ['category-selected'];

    public function categorySelected($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function render()
    {
        // Build query based on selected category
        $query = Complaint::with(['user', 'category'])->latest();

        // Filter by category if not 'semua-pengaduan'
        if ($this->selectedCategory !== 'semua-pengaduan') {
            $query->where('category_id', $this->selectedCategory);
        }

        $complaints = $query->get();

        return view('livewire.homepage.index', [
            'complaints' => $complaints,
        ]);
    }
}
