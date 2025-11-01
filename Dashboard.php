<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Pages\Concerns\UsesPageComponents;
use Filament\Widgets;
use App\Filament\Widgets\StatsOverviewWidget;
use App\Filament\Widgets\ComplaintCategoryChart;
use App\Filament\Widgets\ComplaintStatusChart;

class Dashboard extends BaseDashboard
{
    use UsesPageComponents;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string $view = 'filament.pages.dashboard';

    public function getWidgets(): array
    {
        return [
            StatsOverviewWidget::class,
            ComplaintCategoryChart::class,
            ComplaintStatusChart::class,
        ];
    }
}
