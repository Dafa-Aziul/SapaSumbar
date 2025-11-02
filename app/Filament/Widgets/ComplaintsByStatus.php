<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Widgets\ChartWidget;

class ComplaintsByStatus extends ChartWidget
{
    protected ?string $heading = 'Pengaduan Berdasarkan Status';

    protected function getData(): array
    {
        $data = Complaint::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Status Pengaduan',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#60a5fa', '#facc15', '#34d399', '#f87171',
                    ],
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // tampil seperti pie chart
    }
}
