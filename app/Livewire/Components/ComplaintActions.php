<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintActions extends Component
{
    public $complaint;
    public $hasVoted = false;

    public function mount($complaint)
    {
        // Pastikan complaint valid
        if (is_numeric($complaint)) {
            $this->complaint = Complaint::with(['votes', 'responses'])->find($complaint);
        } else {
            $this->complaint = $complaint;
        }

        // Cek apakah user sudah vote
        if (Auth::check() && $this->complaint) {
            $this->hasVoted = $this->complaint->votes()
                ->where('user_id', Auth::id())
                ->exists();
        }
    }

    public function vote()
    {
        if (!$this->complaint) {
            session()->flash('error', 'Data laporan tidak ditemukan.');
            return;
        }

        if (!Auth::check()) {
            session()->flash('error', 'Harap login untuk memberikan vote.');
            return;
        }

        $voteQuery = $this->complaint->votes()->where('user_id', Auth::id());

        // 🔁 Jika user sudah vote → batalkan (hapus)
        if ($voteQuery->exists()) {
            $voteQuery->delete();
            $this->hasVoted = false;
            session()->flash('success', 'Vote dibatalkan.');
        }
        else {
            $this->complaint->votes()->create([
                'user_id' => Auth::id(),
            ]);
            $this->hasVoted = true;
            session()->flash('success', 'Vote berhasil diberikan!');
        }

        // Refresh relasi votes agar count terupdate
        $this->complaint->refresh();
    }

    public function render()
    {
        return view('livewire.components.complaint-actions');
    }
}
