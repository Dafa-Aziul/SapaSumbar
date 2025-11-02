<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Complaint;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CreateComplaintModal extends Component
{
    use WithFileUploads;

    /** 🧩 State UI */
    public $isOpen = false;

    /** 📝 Form Fields */
    public $kategori;
    public $lokasi;
    public $deskripsi;
    public $foto_bukti;
    public $is_anonymous = false;

    /** 📦 Dropdown Options */
    public $kategoriOptions = [];

    /** 📡 Listener untuk membuka modal */
    protected $listeners = ['openCreateComplaintModal' => 'openModal'];

    /** 📋 Validasi */
    protected $rules = [
        'kategori' => 'required|exists:categories,id',
        'lokasi' => 'nullable|string|max:255',
        'deskripsi' => 'required|string|min:10|max:5000',
        'foto_bukti' => 'nullable|image|max:2048',
        'is_anonymous' => 'boolean',
    ];

    /** 🔓 Buka Modal */
    public function openModal(): void
    {
        $this->resetValidation();
        $this->resetForm();
        $this->isOpen = true;
    }

    /** 🔒 Tutup Modal */
    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    /** ♻️ Reset Form */
    private function resetForm(): void
    {
        $this->reset(['kategori', 'lokasi', 'deskripsi', 'foto_bukti', 'is_anonymous']);
    }

    /** 📤 Kirim Data Pengaduan */
    public function submit(): void
    {
        $this->validate();

        // Simpan pengaduan
        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'category_id' => $this->kategori,
            'content' => $this->deskripsi,
            'location' => $this->lokasi,
            'status' => 'terkirim',
            'is_anonymous' => $this->is_anonymous,
        ]);

        // Upload foto jika ada
        if ($this->foto_bukti) {
            $path = $this->foto_bukti->store('complaints/media', 'public');
            $complaint->media()->create([
                'file_url' => $path,
                'file_type' => 'image',
            ]);
        }

        // 🔹 Kirim event agar daftar pengaduan ter-update
        $this->dispatch('complaintCreated');

        // 🔹 Reset dan tutup modal
        $this->resetForm();
        $this->closeModal();

        // 🔹 Flash pesan sukses
        session()->flash('success', 'Pengaduan berhasil dikirim' . ($this->is_anonymous ? ' secara anonim.' : '!'));
    }

    /** 📦 Render View */
    public function render()
    {
        $this->kategoriOptions = Category::pluck('name', 'id')->toArray();
        return view('livewire.components.create-complaint-modal');
    }
}
