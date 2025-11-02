<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Widgets\ChartWidget;

class ComplaintsByCategory extends ChartWidget
{
    protected ?string $heading = 'Pengaduan Berdasarkan Kategori';

    protected function getData(): array
    {
        $data = Complaint::selectRaw('category_id, COUNT(*) as total')
            ->groupBy('category_id')
            ->pluck('total', 'category_id')
            ->toArray();

        // ubah ID kategori jadi nama kategori kalau relasinya ada
        $labels = [];
        foreach (array_keys($data) as $catId) {
            $labels[] = optional(\App\Models\Category::find($catId))->name ?? 'Tidak diketahui';
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengaduan',
                    'data' => array_values($data),
                    'backgroundColor' => [
                        '#f87171', '#60a5fa', '#facc15', '#34d399', '#a78bfa',
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut'; // tampil seperti donat
    }
}
