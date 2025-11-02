<?php

namespace App\Filament\Widgets;

use App\Models\Complaint;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminDashboardWidget extends StatsOverviewWidget
{
    protected ?string $heading = '📊 SapaSumbar Admin Center!';

    protected function getStats(): array
    {
        $total = Complaint::count();
        $today = Complaint::whereDate('created_at', today())->count();
        $diproses = Complaint::where('status', 'diproses')->count();
        $selesai = Complaint::where('status', 'selesai')->count();

        return [
            Stat::make('Semua Pengaduan', $total)
                ->description('Total laporan yang masuk')
                ->descriptionIcon('heroicon-o-archive-box')
                ->color('primary'),

            Stat::make('Pengaduan Hari Ini', $today)
                ->description('Laporan baru hari ini')
                ->descriptionIcon('heroicon-o-inbox')
                ->color('danger'),

            Stat::make('Sedang Diproses', $diproses)
                ->description('Laporan sedang ditangani')
                ->descriptionIcon('heroicon-o-arrow-path')
                ->color('warning'),

            Stat::make('Selesai', $selesai)
                ->description('Laporan telah diselesaikan')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
        ];
    }
}
