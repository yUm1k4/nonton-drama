<?php

namespace App\Filament\Widgets;

use App\Models\CoinTopUp;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;

class RevenueChartWidget extends ChartWidget
{
    protected ?string $heading = 'Grafik Pendapatan 7 Hari Terakhir';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = collect();
        $labels = collect();

//        for ($i = 6; $i >= 0; $i--) {
//            $date = now()->subDays($i);
//            $labels->push($date->format('d M'));
//
//            $dailyRevenue = CoinTopUp::where('status', 'success')
//                ->whereDate('created_at', $date->format('Y-m-d'))
//                ->sum('amount');
//            $data->push($dailyRevenue);
//        }

        // refactor handle n+1 query cointop up
        $revenues = CoinTopUp::where('status', 'success')
            ->whereBetween('created_at', [now()->subDays(6)->startOfDay(), now()->endOfDay()])
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function ($group) {
                return $group->sum('amount');
            });

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $labels->push($date->format('d M'));
            $data->push($revenues->get($date->format('Y-m-d'), 0));
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pendapatan (Rp)',
                    'data' => $data->toArray(),
                    'backgroundColor' => 'rgba(251, 191, 36, 0.5)', // Warna orange dengan transparansi
                    'borderColor' => 'rgba(251, 191, 36, 1)', // Warna orange solid
                    'borderWidth' => 2,
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

//    protected function getOptions(): array|RawJs|null
//    {
//        return [
//            'plugins' => [
//                'legend' => [
//                    'display' => false,
//                ],
//            ],
//            'scales' => [
//                'y' => [
//                    'beginAtZero' => true,
//                    'ticks' => [
//                        'callback' => "function(value) { return 'Rp ' + value.toLocaleString('id-ID'); }",
//                    ],
//                ],
//            ],
//        ];
//    }
}
