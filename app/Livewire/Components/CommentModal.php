<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Complaint;
use App\Models\Response;
use Illuminate\Support\Facades\Auth;

class CommentModal extends Component
{
    /** 🧩 State UI */
    public $isOpen = false;

    /** 🧾 Data komentar & laporan */
    public $complaint;
    public $comment = '';

    /** 🎧 Listener global (supaya bisa dipanggil dari card mana pun) */
    protected $listeners = ['openCommentModal' => 'openModal'];

    /** 🔓 Buka modal komentar untuk laporan tertentu */
    public function openModal($id = null)
    {
        if (!$id) return;

        $this->resetValidation();
        $this->reset(['comment']);

        $this->complaint = \App\Models\Complaint::with('responses.user')->find($id);
        $this->isOpen = true;
    }


    /** 🔒 Tutup modal */
    public function closeModal()
    {
        $this->isOpen = false;
    }

    /** 💬 Tambah komentar */
    public function submitComment()
    {
        $this->validate([
            'comment' => 'required|string|min:2|max:500',
        ]);

        if (!$this->complaint) {
            return;
        }

        Response::create([
            'complaint_id' => $this->complaint->id,
            'user_id' => Auth::id(),
            'content' => $this->comment,
        ]);

        // refresh komentar
        $this->complaint->load('responses.user');
        $this->comment = '';

        session()->flash('success', 'Komentar berhasil ditambahkan!');
    }

    public function render()
    {
        return view('livewire.components.comment-modal');
    }
}
