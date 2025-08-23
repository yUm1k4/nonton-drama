<?php

namespace App\Filament\Resources\UnlockedEpisodes\Pages;

use App\Filament\Resources\UnlockedEpisodes\UnlockedEpisodeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUnlockedEpisode extends EditRecord
{
    protected static string $resource = UnlockedEpisodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
