<?php
namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\OrderItem;

class SalesByDay extends ChartWidget
{
      protected ?string $heading = 'Ventas últimos 7 días';

    protected function getType(): string
    {
        return 'bar'; // Puede ser 'line', 'bar', 'pie'...
    }

    protected function getData(): array
    {
        $data = OrderItem::where('created_at', '>=', now()->subDays(7))
            ->get()
            ->groupBy(fn($item) => $item->created_at->format('d-m-y'));

        return [
            'labels' => array_keys($data->toArray()),
            'datasets' => [
                [
                    'label' => 'Ventas (€)',
                    'data' => array_map(fn($items) => collect($items)->sum('total_price'), $data->toArray()),
                    'backgroundColor' => '#3b82f6', // azul
                    'borderColor' => '#1e40af',
                ],
            ],
        ];
    }
}
