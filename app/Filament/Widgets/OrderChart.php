<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class OrderChart extends ChartWidget
{
    protected ?string $heading = 'Orders Overview';
    // protected ?string $maxHeight = '250px';

    protected string $color = 'info';

    public ?string $filter = '2025';

    protected function getData(): array
    {
        $activeFilter = $this->filter;

        $orders = Order::query()
            ->select(
                DB::raw('COUNT(*) as count'),
                DB::raw("strftime('%m', created_at) as month")
            )
            ->where(DB::raw("strftime('%Y', created_at)"), '=', $activeFilter)
            ->whereRaw("strftime('%Y', created_at) = ?", [now()->format('Y')])
            ->groupBy(DB::raw("strftime('%m', created_at)"))
            ->pluck('count', 'month')
            ->toArray();

        $months = collect(range(1, 12))->mapWithKeys(fn($m) => [str_pad($m, 2, '0', STR_PAD_LEFT) => 0]);

        $data = $months->merge($orders)->mapWithKeys(function ($count, $month) {
            return [date('M', mktime(0, 0, 0, (int)$month, 1)) => $count];
        })->toArray();


        return [
            'datasets' => [
                [
                    'label' => 'Orders Monthly',
                    'data' => array_values($data),
                    'backgroundColor' => '#36A2EB',
                    // 'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => array_keys($data),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getFilters(): ?array
    {
        return [
            2025 => '2025',
            2024 => '2024',
            2023 => '2023',
            2022 => '2022',
        ];
    }
}
