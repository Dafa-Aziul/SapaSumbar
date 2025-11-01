<?php

namespace App\Livewire\Components;

use App\Models\Complaint;
use Livewire\Component;

class ReportList extends Component
{
    public function render()
    {
        $complaints = Complaint::with(['user', 'category', 'media', 'votes', 'responses'])
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.components.report-list', [
            'complaints' => $complaints
        ]);
    }
}

