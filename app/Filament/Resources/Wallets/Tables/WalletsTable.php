<?php

namespace App\Filament\Resources\Wallets\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WalletsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pengguna')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('coin_balance')
                    ->label('Saldo Koin')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Tanggal Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
            ])
            ->toolbarActions([
            ]);
    }
}
