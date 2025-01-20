<?php

namespace App\Filament\Widgets;

use App\Models\Faktur;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsDashboard extends BaseWidget
{
    protected function getStats(): array
    {
        $countFacture = Faktur::count();
        return [
            Stat::make('Jumlah Faktur', $countFacture, 'Faktur'),
            Stat::make('Bounce rate', '21%'),
            Stat::make('Average time on page', '3:12'),
        ];
    }
}
