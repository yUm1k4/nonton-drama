<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->disk('public')
                    ->required()
                    ->directory('banners')
                    ->maxSize(2048) // Max size in KB (2MB)
                    ->helperText('Recommended dimensions: 1200x300 pixels. Max size: 2MB.')
                    ->columnSpanFull(),
                TextInput::make('title')
                    ->label('Judul Banner')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('link_url')
                    ->label('Link Banner')
                    ->url()
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }
}
