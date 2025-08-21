<?php

namespace App\Filament\Resources\Genres\Pages;

use App\Filament\Resources\Genres\GenreResource;
use Filament\Resources\Pages\CreateRecord;

class CreateGenre extends CreateRecord
{
    protected static string $resource = GenreResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Genre berhasil dibuat';
    }
}
