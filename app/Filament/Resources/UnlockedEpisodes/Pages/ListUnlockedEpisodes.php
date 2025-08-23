<?php

namespace App\Filament\Resources\UnlockedEpisodes\Pages;

use App\Filament\Resources\UnlockedEpisodes\UnlockedEpisodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUnlockedEpisodes extends ListRecords
{
    protected static string $resource = UnlockedEpisodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
