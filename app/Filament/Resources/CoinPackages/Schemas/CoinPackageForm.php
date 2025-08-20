<?php

namespace App\Filament\Resources\CoinPackages\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;

class CoinPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Paket Koin')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('coin_amount')
                    ->label('Jumlah Koin')
                    ->numeric()
                    ->required()
                    ->minValue(1)
                    ->maxValue(1000000),
                TextInput::make('bonus_amount')
                    ->label('Jumlah Bonus Koin')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->maxValue(1000000),
                TextInput::make('price')
                    ->label('Harga Paket Koin')
                    ->numeric()
                    ->required()
                    ->minValue(0)
                    ->maxValue(1000000)
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('Rp. '),
                Toggle::make('is_active')
                    ->label('Aktifkan Paket Koin')
                    ->default(true)
                    ->inline()
                    ->helperText('Paket koin ini akan tersedia untuk pembelian jika diaktifkan.')
                    ->columnSpanFull(),
            ]);
    }
}
