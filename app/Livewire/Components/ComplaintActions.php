<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ComplaintActions extends Component
{
    public $complaint;
    public $hasVoted = false;
    public $showCommentModal = false;
    public $comment = '';

    public function mount($complaint)
    {
        $this->complaint = is_numeric($complaint)
            ? Complaint::with(['votes', 'responses'])->find($complaint)
            : $complaint;

        $this->hasVoted = Auth::check() &&
            $this->complaint->votes()->where('user_id', Auth::id())->exists();
    }

    public function vote()
    {
        if (!Auth::check()) return;
        if (Gate::denies('user')) {
            return;
        }
        $voteQuery = $this->complaint->votes()->where('user_id', Auth::id());

        if ($voteQuery->exists()) {
            $voteQuery->delete();
            $this->hasVoted = false;
        } else {
            $this->complaint->votes()->create(['user_id' => Auth::id()]);
            $this->hasVoted = true;
        }

        $this->complaint->refresh();
    }

    public function openCommentModal()
    {
        // 🔥 kirim event global untuk dibaca oleh Livewire CommentModal
        $this->dispatch('openCommentModal', id: $this->complaint->id);
    }






    public function closeCommentModal()
    {
        $this->showCommentModal = false;
    }

    public function submitComment()
    {
        $this->validate(['comment' => 'required|string|max:500']);

        $this->complaint->responses()->create([
            'user_id' => Auth::id(),
            'content' => $this->comment,
        ]);

        $this->complaint->refresh();
        $this->comment = '';
    }

    public function render()
    {
        return view('livewire.components.complaint-actions');
    }
}
