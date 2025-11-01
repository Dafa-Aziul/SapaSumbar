<?php

namespace App\Livewire\Components;

use App\Models\Complaint;
use Livewire\Component;

class ReportCard extends Component
{
    public $complaint;

    public function mount($complaint)
    {
        if (is_numeric($complaint)) {
            $this->complaint = Complaint::with(['user', 'category', 'media', 'votes', 'responses'])->find($complaint);
        } elseif ($complaint instanceof Complaint) {
            $this->complaint = $complaint->load(['user', 'category', 'media', 'votes', 'responses']);
        } else {
            $this->complaint = $complaint;
        }
    }

    public function vote()
    {
        // TODO: Implement vote functionality
    }

    public function render()
    {
        return view('livewire.components.report-card');
    }
}

