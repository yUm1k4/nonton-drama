<?php

namespace App\Filament\Widgets;

use App\Models\CoinTopUp;
use Filament\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LatestTopUpsWidget extends TableWidget
{
    protected static ?string $heading = 'Top Up Koin Terbaru';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CoinTopUp::query()
                    ->with(['user', 'coinPackage'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->limit(20)
                    ->tooltip(fn (CoinTopUp $record): string => $record->user->name),
                TextColumn::make('coinPackage.title')
                    ->label('Paket')
                    ->limit(25)
                    ->tooltip(fn (CoinTopUp $record): string => $record->coinPackage->title ?? '-'),
                TextColumn::make('coinPackage.price')
                    ->label('Harga (Rp)')
                    ->formatStateUsing(fn ($state) => $state ? 'Rp ' . number_format($state, 0, ',', '.') : '-')
                    ->color('primary')
                    ->sortable(),
                TextColumn::make('coin_amount')
                    ->label('Jumlah Koin')
                    ->formatStateUsing(fn ($state) => $state . ' koin')
                    ->color('warning')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'pending' => 'secondary',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since()
                    ->sortable()
                    ->tooltip(fn (CoinTopUp $record): string => $record->created_at->format('d M Y H:i')),
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
