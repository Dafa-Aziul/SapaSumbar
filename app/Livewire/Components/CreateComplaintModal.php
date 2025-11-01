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

    /** 📦 Dropdown Options */
    public $kategoriOptions = [];

    /** 🎧 Listener untuk membuka modal dari komponen lain */
    protected $listeners = ['openCreateComplaintModal' => 'openModal'];

    /** 📋 Validasi Input */
    protected $rules = [
        'kategori' => 'required|exists:categories,id',
        'lokasi' => 'nullable|string|max:255',
        'deskripsi' => 'required|string|min:10|max:5000',
        'foto_bukti' => 'nullable|image|max:2048',
    ];

    /**
     * 🔓 Buka Modal
     */
    public function openModal(): void
    {
        $this->resetValidation();
        $this->resetForm();
        $this->isOpen = true;
    }

    /**
     * 🔒 Tutup Modal
     */
    public function closeModal(): void
    {
        $this->isOpen = false;
    }

    /**
     * ♻️ Reset Form
     */
    private function resetForm(): void
    {
        $this->reset(['kategori', 'lokasi', 'deskripsi', 'foto_bukti']);
    }

    /**
     * 📤 Kirim Data Pengaduan
     */
    public function submit(): void
    {
        $this->validate();

        // 🔹 Buat data pengaduan baru
        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'category_id' => $this->kategori,
            'content' => $this->deskripsi,
            'location' => $this->lokasi,
            'status' => 'pending',
        ]);

        // 🔹 Upload foto (jika ada)
        if ($this->foto_bukti) {
            $path = $this->foto_bukti->store('complaints', 'public');

            $complaint->media()->create([
                'file_url' => 'storage/' . $path,
                'file_type' => 'image', // ✅ sudah benar
            ]);
        }

        // 🔹 Beri tahu komponen lain agar daftar pengaduan di-refresh
        $this->dispatch('complaintCreated');

        // 🔹 Reset dan tutup modal
        $this->resetForm();
        $this->closeModal();

        // 🔹 Notifikasi sukses
        session()->flash('success', 'Pengaduan berhasil dikirim!');
    }

    /**
     * 📦 Render tampilan
     */
    public function render()
    {
        // Ambil kategori terbaru setiap kali render
        $this->kategoriOptions = Category::pluck('name', 'id')->toArray();

        return view('livewire.components.create-complaint-modal');
    }
}
