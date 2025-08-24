<?php

namespace App\Filament\Widgets;

use App\Models\CoinTopUp;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class RevenueStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();

        $revenueToday = CoinTopUp::where('status', 'success')
            ->whereDate('created_at', $today)
            ->sum('amount');
        $revenueThisWeek = CoinTopUp::where('status', 'success')
            ->whereBetween('created_at', [$weekStart, Carbon::now()])
            ->sum('amount');
        $totalRevenue = CoinTopUp::where('status', 'success')->sum('amount');
        $topUpsToday = CoinTopUp::where('status', 'success')
            ->whereDate('created_at', $today)
            ->count();

        return [
            Stat::make('Pendapatan Hari Ini', 'Rp ' . number_format($revenueToday, 0, ',', '.'))
                ->description("Dari $topUpsToday top-up koin yang berhasil hari ini.")
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('success'),

            Stat::make('Pendapatan Minggu Ini', 'Rp ' . number_format($revenueThisWeek, 0, ',', '.'))
                ->description('Total pendapatan dari top-up koin minggu ini.')
                ->descriptionIcon('heroicon-m-chart-bar-square')
                ->color('info'),

            Stat::make('Total Pendapatan', 'Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->description('Total pendapatan dari semua top-up koin.')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('primary')
        ];
    }
}
