<?php

namespace App\Filament\Resources\Series\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SeriesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('genre_id')
                    ->label('Genre')
                    ->relationship('genre', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('title')
                    ->label('Judul Series')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                RichEditor::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->maxLength(5000)
                    ->columnSpanFull(),
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->required()
                    ->maxSize(2048) // 2MB
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpanFull(),
                TextInput::make('age_rating')
                    ->label('Rating Usia')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(18)
                    ->default(0)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('release_year')
                    ->label('Tahun Rilis')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(date('Y'))
                    ->default(date('Y'))
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_trending')
                    ->label('Tampilkan di Halaman Trending')
                    ->required()
                    ->default(false),
                Toggle::make('is_top_choice')
                    ->label('Tampilkan di Halaman Pilihan Terpopuler')
                    ->required()
                    ->default(false),

                Repeater::make('episodes')
                    ->label('Episode Series')
                    ->relationship('episodes')
                    ->schema([
                        TextInput::make('episode_number')
                            ->label('Nomor Episode')
                            ->numeric()
                            ->minValue(1)
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(10),
                        TextInput::make('title')
                            ->label('Judul Episode')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('description')
                            ->label('Deskripsi Episode')
                            ->maxLength(255),
                        FileUpload::make('video')
                            ->label('Video Episode')
                            ->required()
                            ->acceptedFileTypes(['video/mp4', 'video/mkv'])
                            ->maxSize(10240) // 10MB
                            ->columnSpanFull(),
                        Toggle::make('is_locked')
                            ->label('Kunci Episode')
                            ->default(false)
                            ->helperText('Jika diaktifkan, episode ini akan terkunci dan hanya dapat diakses setelah membuka kunci dengan koin.'),
                        TextInput::make('unlock_cost')
                            ->label('Biaya Pembukaan Kunci (Koin)')
                            ->numeric()
                            ->minValue(0)
                            ->default(0)
                            ->helperText('Jumlah koin yang diperlukan untuk membuka kunci episode ini.')
                    ])
                    ->grid(2)
                    ->collapsed(false)
                    ->columnSpanFull(),
            ]);
    }
}
