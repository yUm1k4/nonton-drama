<?php

namespace App\Filament\Resources\CoinPackages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CoinPackagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Paket Koin')
                    ->searchable(),
                TextColumn::make('coin_amount')
                    ->label('Jumlah Koin')
                    ->searchable(),
                TextColumn::make('bonus_amount')
                    ->label('Jumlah Bonus Koin')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga Paket Koin')
                    ->searchable()
                    ->formatStateUsing(fn ($state) => 'Rp. ' . number_format($state, 0, ',', '.')),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                TextColumn::make('display_order')
                    ->label('Urutan Tampilan'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('Edit Paket Koin')
                    ->icon('heroicon-o-pencil-square'),
                DeleteAction::make()
                    ->label('Hapus Paket Koin')
                    ->icon('heroicon-o-trash')
                    ->successNotificationTitle('Paket koin berhasil dihapus.')
                    ->color('danger'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('display_order')
            ->defaultSort('display_order', 'asc');
    }
}
