<?php

namespace App\Filament\Resources\UnlockedEpisodes\Tables;

use App\Models\SeriesEpisode;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UnlockedEpisodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('user.email')
                    ->label('Email User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('seriesEpisode.series.title')
                    ->label('Judul Series')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('seriesEpisode.episode_number')
                    ->label('Episode')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Unlock')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable(),
                SelectFilter::make('series_episode_id')
                    ->label('Episode')
                    ->options(SeriesEpisode::pluck('title', 'id'))
                    ->searchable(),
            ])
            ->recordActions([
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
