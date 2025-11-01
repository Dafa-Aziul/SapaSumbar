<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class CreateReportModal extends Component
{
    use WithFileUploads;

    public $isOpen = false;

    // Form fields
    public $kategori = '';
    public $kota_kabupaten = '';
    public $lokasi = '';
    public $deskripsi = '';
    public $foto_bukti;

    // Dropdown options
    public $kategoriOptions = [
        'pungli' => 'Pungli',
        'kerusakan' => 'Kerusakan',
        'darurat' => 'Darurat',
    ];

    public $kotaKabupatenOptions = [
        'bukittinggi' => 'Bukittinggi',
        'padang' => 'Padang',
        'padangpanjang' => 'Padang Panjang',
        'agamtimur' => 'Agam Timur',
    ];

    // Event listener dari komponen lain (misal SidebarRight)
    protected $listeners = ['openCreateComplaintModal' => 'openModal'];

    // Buka modal
    public function openModal()
    {
        $this->resetValidation();
        $this->resetForm();
        $this->isOpen = true;
    }

    // Tutup modal
    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
        $this->dispatch('modalClosed');
    }

    // Reset form
    public function resetForm()
    {
        $this->kategori = '';
        $this->kota_kabupaten = '';
        $this->lokasi = '';
        $this->deskripsi = '';
        $this->foto_bukti = null;
    }

    // Validasi & simpan
    public function submit()
    {
        $this->validate([
            'kategori' => 'required',
            'kota_kabupaten' => 'required',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string|min:10|max:5000',
            'foto_bukti' => 'nullable|image|max:5120', // 5MB
        ]);

        // Simpan ke database
        $complaint = Complaint::create([
            'user_id' => Auth::id(),
            'category_id' => $this->kategori,
            'location' => $this->lokasi,
            'region' => $this->kota_kabupaten,
            'content' => $this->deskripsi,
            'status' => 'pending',
        ]);

        // Simpan gambar jika ada
        if ($this->foto_bukti) {
            $path = $this->foto_bukti->store('complaints', 'public');
            $complaint->media()->create([
                'file_url' => 'storage/' . $path,
                'type' => 'image',
            ]);
        }

        // Tutup modal & kirim event
        $this->closeModal();

        // Flash message + event refresh daftar pengaduan
        session()->flash('success', 'Pengaduan berhasil dikirim!');
        $this->dispatch('complaintCreated');
    }

    public function render()
    {
        return view('livewire.components.create-report-modal');
    }
}
