<?php
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\OrderItem;

class SalesStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Ventas totales', OrderItem::sum('total_price') . ' €')
                ->color('success'),

            Stat::make('Pedidos realizados', OrderItem::count())
                ->color('primary'),
        ];
    }
}