<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('profile_picture')
                    ->default(fn(User $record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->name))
                    ->circular()
                    ->imageSize(80)
                    ->disk('public')
                    ->label('Foto Profil'),
                TextColumn::make('name')
                    ->label('Nama Pengguna')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email Pengguna')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('role')
                    ->label('Role')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->successNotificationTitle('User berhasil dihapus.'),
                ])
            ->toolbarActions([
                BulkActionGroup::make([
//                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
