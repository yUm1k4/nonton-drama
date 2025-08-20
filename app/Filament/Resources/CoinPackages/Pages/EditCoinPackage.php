<?php

namespace App\Filament\Resources\CoinPackages\Pages;

use App\Filament\Resources\CoinPackages\CoinPackageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCoinPackage extends EditRecord
{
    protected static string $resource = CoinPackageResource::class;

    protected function getRedirectUrl(): ?string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return __('Harga Koin berhasil diperbarui.');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
