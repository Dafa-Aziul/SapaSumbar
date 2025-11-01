<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class ComplaintCard extends Component
{
    public $complaint;
    public $hasVoted = false;

    public function mount($complaint)
    {
        if (is_numeric($complaint)) {
            $this->complaint = Complaint::with(['user', 'category', 'media', 'votes', 'responses'])
                ->find($complaint);
        } else {
            $this->complaint = $complaint;
        }

        if (Auth::check()) {
            $this->hasVoted = $this->complaint->votes()
                ->where('user_id', Auth::id())
                ->exists();
        }
    }

    public function vote()
    {
        if (!Auth::check()) {
            session()->flash('error', 'Harap login untuk memberikan vote.');
            return;
        }

        $alreadyVoted = $this->complaint->votes()
            ->where('user_id', Auth::id())
            ->exists();

        if ($alreadyVoted) {
            $this->hasVoted = true;
            return;
        }

        $this->complaint->votes()->create([
            'user_id' => Auth::id(),
        ]);

        $this->hasVoted = true;
        $this->complaint->refresh();
    }

    public function testClick()
    {
        dd('ComplaintCard aktif!');
    }

    public function hydrate()
    {
        logger('✅ ComplaintCard di-hydrate!');
    }


    public function render()
    {
        return view('livewire.components.complaint-card');
    }
}
