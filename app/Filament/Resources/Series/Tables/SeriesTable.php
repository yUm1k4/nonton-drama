<?php

namespace App\Filament\Resources\Series\Tables;

use App\Models\Genre;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SeriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('genre.name')
                    ->label('Genre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('age_rating')
                    ->label('Rating Usia')
                    ->sortable()
                    ->searchable()
                    ->suffix('+')
                    ->numeric(),
                TextColumn::make('release_year')
                    ->label('Tahun Rilis')
                    ->sortable()
                    ->searchable(),
                ToggleColumn::make('is_trending')
                    ->label('Trending')
                    ->sortable()
                    ->toggleable(),
                ToggleColumn::make('is_top_choice')
                    ->label('Pilihan Teratas')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Tanggal Diubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('genre_id')
                    ->label('Genre')
                    ->options(Genre::pluck('name', 'id')->all())
                    ->searchable(),
                SelectFilter::make('is_trending')
                    ->label('Trending')
                    ->options([
                        true => 'Ya',
                        false => 'Tidak',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
