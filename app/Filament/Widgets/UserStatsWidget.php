<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class UserStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();

        $newUsersToday = User::where('role', 'user')
            ->whereDate('created_at', $today)
            ->count();
        $newUsersThisWeek = User::where('role', 'user')
            ->whereBetween('created_at', [$weekStart, Carbon::now()])
            ->count();
        $totalUsers = User::where('role', 'user')->count();

        return [
            Stat::make('Pengguna Baru Hari Ini', $newUsersToday)
                ->description('Pengguna baru yang mendaftar hari ini.')
                ->descriptionIcon('heroicon-m-user-plus')
                ->color('success'),

            Stat::make('Pengguna Baru Minggu Ini', $newUsersThisWeek)
                ->description('Pengguna baru yang mendaftar minggu ini.')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('info'),

            Stat::make('Total Pengguna', $totalUsers)
                ->description('Total pengguna terdaftar.')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary')
        ];
    }
}
