<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    public $name;
    public $email;
    public $no_wa;

    public function mount()
    {
        // Pastikan user login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $this->name = $user->name ?? '';
        $this->email = $user->email ?? '';
        $this->no_wa = $user->no_wa ?? '';
    }

    public function render()
    {
        return view('livewire.profile.index');
    }
}
