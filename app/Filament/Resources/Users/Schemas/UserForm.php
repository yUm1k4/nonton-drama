<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('profile_picture')
                    ->label('Foto Profil')
                    ->image()
                    ->maxSize(2048) // 2 MB
                    ->acceptedFileTypes(['image/*'])
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label('Nama Pengguna')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('email')
                    ->label('Email Pengguna')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('password')
                    ->label('Kata Sandi')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state)) // agar tidak mengirimkan password kosong saat update
                    ->minLength(8)
                    ->maxLength(100),
                Select::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'user' => 'User',
                    ])
                    ->default('user')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
