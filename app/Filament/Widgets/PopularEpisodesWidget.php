<?php

namespace App\Filament\Widgets;

use App\Models\SeriesEpisode;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class PopularEpisodesWidget extends TableWidget
{
    protected static ?string $heading = 'Episode Paling Populer Minggu Ini';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        $weekStart = now()->startOfWeek();

        return $table
            ->query(
                SeriesEpisode::query()
                    ->whereHas('unlockedEpisodes', function (Builder $query) use ($weekStart) {
                        $query->whereBetween('created_at', [$weekStart, now()]);
                    })
                    ->withCount(['unlockedEpisodes as unlocks_this_week' => function (Builder $query) use ($weekStart) {
                        $query->whereBetween('created_at', [$weekStart, now()]);
                    }])
                    ->with(['series'])
                    ->orderByDesc('unlocks_this_week')
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('series.title')
                    ->label('Series')
                    ->limit(30)
                    ->tooltip(fn (SeriesEpisode $record): string => $record->series->title),
                TextColumn::make('episode_number')
                    ->label('Eps')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul Episode')
                    ->limit(40)
                    ->tooltip(fn (SeriesEpisode $record): string => $record->title),
                TextColumn::make('unlocks_this_week')
                    ->label('Unlocks Minggu Ini')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                TextColumn::make('unlock_cost')
                    ->label('Biaya Unlock (Koin)')
                    ->formatStateUsing(fn ($state) => $state . ' koin')
                    ->badge()
                    ->color('warning')
                    ->sortable(),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
