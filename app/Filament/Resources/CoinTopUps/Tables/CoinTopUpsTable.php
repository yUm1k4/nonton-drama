<?php

namespace App\Filament\Resources\CoinTopUps\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CoinTopUpsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Pengguna')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('coinPackage.title')
                    ->label('Paket Koin')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('coin_amount')
                    ->label('Jumlah Koin')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('amount')
                    ->label('Total Harga')
                    ->sortable()
                    ->searchable()
                    ->formatStateUsing(fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')),
                TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'success' => 'success',
                        'failed' => 'danger',
                        default => 'secondary',
                    }),
                TextColumn::make('created_at')
                    ->label('Tanggal Top Up')
                    ->sortable()
                    ->searchable()
                    ->dateTime('d M Y H:i:s'),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name')
                    ->searchable(),
                SelectFilter::make('coin_package_id')
                    ->label('Paket Koin')
                    ->options(fn () => \App\Models\CoinPackage::query()
                        ->pluck('title', 'id')
                        ->toArray())
                    ->searchable(),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Sukses',
                        'failed' => 'Gagal',
                    ])
                    ->searchable(),
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }
}
