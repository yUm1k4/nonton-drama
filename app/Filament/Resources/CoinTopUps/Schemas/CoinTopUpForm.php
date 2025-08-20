<?php

namespace App\Filament\Resources\CoinTopUps\Schemas;

use App\Models\CoinPackage;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CoinTopUpForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('code')
                    ->label('Kode Top Up')
                    ->default('TOPUP-' . Str::random(10))
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->readonly(),
                Select::make('user_id')
                    ->label('Pengguna')
                    ->relationship('user', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('coin_package_id')
                    ->label('Paket Koin')
                    ->options(function () {
                        return CoinPackage::query()
                            ->pluck('title', 'id')
                            ->toArray();
                    })
                    ->required()
                    ->searchable(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'success' => 'Sukses',
                        'failed' => 'Gagal',
                    ])
                    ->default('pending')
                    ->required(),
            ]);
    }
}
