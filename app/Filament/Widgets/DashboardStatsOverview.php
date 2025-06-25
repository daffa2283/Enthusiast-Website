<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

class DashboardStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('All products in inventory')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),
            
            Stat::make('Active Products', Product::where('is_active', true)->count())
                ->description('Currently active products')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('info'),
            
            Stat::make('Low Stock Products', Product::where('stock', '<', 10)->count())
                ->description('Products with less than 10 items')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),
            
            Stat::make('Total Orders', Order::count())
                ->description('All time orders')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('primary'),
            
            Stat::make('Pending Orders', Order::where('status', 'pending')->count())
                ->description('Orders awaiting processing')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            
            Stat::make('Total Revenue', 'Rp ' . number_format(Order::where('payment_status', 'paid')->sum('total'), 0, ',', '.'))
                ->description('From paid orders')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}