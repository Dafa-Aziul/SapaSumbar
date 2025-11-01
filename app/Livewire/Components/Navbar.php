<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\ComplaintProgress;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $searchQuery = '';
    public $showMobileMenu = false;
    public $showMobileSearch = false;
    public $unreadNotificationsCount = 0;

    public function mount()
    {
        $this->updateUnreadCount();
    }

    public function updateUnreadCount()
    {
        if (Auth::check()) {
            // Hitung jumlah progress pengaduan yang belum "dibaca" (untuk sementara semua dianggap unread)
            $this->unreadNotificationsCount = ComplaintProgress::whereHas('complaint', function($query) {
                $query->where('user_id', Auth::id());
            })->count();
        }
    }

    public function render()
    {
        return view('livewire.components.navbar');
    }
}
