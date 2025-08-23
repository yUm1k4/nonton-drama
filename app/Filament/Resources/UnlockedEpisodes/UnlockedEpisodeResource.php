<?php

namespace App\Filament\Resources\UnlockedEpisodes;

use App\Filament\Resources\UnlockedEpisodes\Pages\CreateUnlockedEpisode;
use App\Filament\Resources\UnlockedEpisodes\Pages\EditUnlockedEpisode;
use App\Filament\Resources\UnlockedEpisodes\Pages\ListUnlockedEpisodes;
use App\Filament\Resources\UnlockedEpisodes\Schemas\UnlockedEpisodeForm;
use App\Filament\Resources\UnlockedEpisodes\Tables\UnlockedEpisodesTable;
use App\Models\UnlockedEpisode;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class UnlockedEpisodeResource extends Resource
{
    protected static ?string $model = UnlockedEpisode::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::LockOpen;

    protected static string | UnitEnum | null $navigationGroup = 'Manajemen User';

    protected static ?string $navigationLabel = 'Riwayat Unlock Episode';

    protected static ?string $pluralModelLabel = 'Riwayat Unlock Episode';

    protected static ?string $pluralLabel = 'Riwayat Unlock Episode';

    public static function form(Schema $schema): Schema
    {
        return UnlockedEpisodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UnlockedEpisodesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUnlockedEpisodes::route('/'),
            'create' => CreateUnlockedEpisode::route('/create'),
            'edit' => EditUnlockedEpisode::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
