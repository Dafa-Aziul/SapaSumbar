<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithFileUploads;

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
    
    public $kotaKabupatenOptions = [];
    
    protected $listeners = [
        'open-create-modal' => 'openModal'
    ];

    public function openModal()
    {
        $this->isOpen = true;
        $this->dispatch('$refresh');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
        $this->dispatch('modal-closed');
    }

    public function resetForm()
    {
        $this->kategori = '';
        $this->kota_kabupaten = '';
        $this->lokasi = '';
        $this->deskripsi = '';
        $this->foto_bukti = null;
    }

    public function submit()
    {
        // Validation
        $this->validate([
            'kategori' => 'required',
            'kota_kabupaten' => 'required',
            'lokasi' => 'required',
            'deskripsi' => 'required|min:10',
            'foto_bukti' => 'nullable|image|max:5120', // 5MB max
        ]);

        // TODO: Implement save logic here
        // After save, close modal
        $this->closeModal();
        
        // Optionally show success message
        session()->flash('message', 'Pengaduan berhasil dikirim!');
    }

    public function render()
    {
        return view('livewire.components.create-report-modal');
    }
}
