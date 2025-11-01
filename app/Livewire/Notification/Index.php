<?php

namespace App\Livewire\Notification;

use Livewire\Component;
use App\Models\ComplaintProgress;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $notifications = [];

    public function mount()
    {
        // Ambil progress dari pengaduan milik user yang sedang login
        $progressUpdates = ComplaintProgress::with(['complaint', 'admin'])
            ->whereHas('complaint', function($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->get();

        // Format sebagai notifikasi
        $this->notifications = $progressUpdates->map(function($progress) {
            return [
                'id' => $progress->id,
                'title' => 'Update Progres Pengaduan #' . $progress->complaint_id,
                'description' => $progress->status_update . ': ' . ($progress->description ?? 'Progres terbaru telah ditambahkan'),
                'is_read' => false, // Untuk sementara semua dianggap unread
                'created_at' => $progress->created_at,
            ];
        })->toArray();
    }

    public function markAsRead($notificationId)
    {
        // Untuk sementara, tidak ada logika mark as read karena belum ada tabel notifikasi
        // Bisa diimplementasikan nanti jika diperlukan
    }

    public function render()
    {
        return view('livewire.notification.index', [
            'notifications' => $this->notifications,
        ]);
    }
}
