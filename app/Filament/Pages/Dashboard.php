<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\RevenueChartWidget;
use App\Filament\Widgets\RevenueStatsWidget;
use App\Filament\Widgets\UserStatsWidget;
use BackedEnum;
use Filament\Facades\Filament;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use Filament\View\PanelsIconAlias;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    public static function getNavigationIcon(): string | BackedEnum | Htmlable | null
    {
        return FilamentIcon::resolve(PanelsIconAlias::PAGES_DASHBOARD_NAVIGATION_ITEM)
            ?? (Filament::hasTopNavigation() ? Heroicon::Home : Heroicon::OutlinedHome);
    }

    public function getWidgets(): array
    {
        return [
            UserStatsWidget::class,
            RevenueStatsWidget::class,
            RevenueChartWidget::class,
        ];
    }
}
