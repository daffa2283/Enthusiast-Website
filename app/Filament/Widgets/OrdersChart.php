<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Order;
use Carbon\Carbon;

class OrdersChart extends ChartWidget
{
    protected static ?string $heading = 'Orders Overview';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = $this->getOrdersPerMonth();

        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data['ordersPerMonth'],
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
                [
                    'label' => 'Revenue (in thousands)',
                    'data' => $data['revenuePerMonth'],
                    'borderColor' => '#3B82F6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    private function getOrdersPerMonth(): array
    {
        $now = Carbon::now();
        $months = [];
        $ordersPerMonth = [];
        $revenuePerMonth = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = $now->copy()->subMonths($i);
            $months[] = $month->format('M Y');
            
            $ordersCount = Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
            
            $revenue = Order::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->where('payment_status', 'paid')
                ->sum('total');
            
            $ordersPerMonth[] = $ordersCount;
            $revenuePerMonth[] = round($revenue / 1000); // Convert to thousands
        }

        return [
            'months' => $months,
            'ordersPerMonth' => $ordersPerMonth,
            'revenuePerMonth' => $revenuePerMonth,
        ];
    }
}