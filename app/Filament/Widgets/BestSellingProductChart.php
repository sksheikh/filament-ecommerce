<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Widgets\ChartWidget;

class BestSellingProductChart extends ChartWidget
{
    protected ?string $heading = 'Best Selling Product';
    protected ?string $maxHeight = '280px';

    protected function getData(): array
    {
        $products = Product::query()
            ->withCount('orderItems as order_count')
            ->orderBy('order_count', 'desc')
            ->limit(5)
            ->pluck('order_count', 'name')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Best Selling Products',
                    'data' => array_values($products),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                    ],
                ],
            ],
            'labels' => array_keys($products),


        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
