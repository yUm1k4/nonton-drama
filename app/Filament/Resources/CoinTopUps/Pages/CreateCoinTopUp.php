<?php

namespace App\Filament\Resources\CoinTopUps\Pages;

use App\Filament\Resources\CoinTopUps\CoinTopUpResource;
use App\Models\CoinPackage;
use Filament\Resources\Pages\CreateRecord;

class CreateCoinTopUp extends CreateRecord
{
    protected static string $resource = CoinTopUpResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Top Up Koin berhasil dibuat';
    }

    /**
     * Method ini dipake untuk memodifikasi data form sebelum dibuat.
     *
     * @param array $data
     * @return array|mixed[]
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $coinPackage = CoinPackage::find($data['coin_package_id']);
        if ($coinPackage) {
            $data['coin_amount'] = $coinPackage->amount + $coinPackage->bonus_amount;
            $data['amount'] = $coinPackage->price;
        }

        return $data;
    }

    protected function afterCreate(): void
    {
        // ketika top up berhasil, update saldo koin pengguna
        if ($this->record->status === 'success') {
            $this->record?->user?->wallet?->update([
                'coin_balance' => $this->record->user->wallet->coin_balance + $this->record->coin_amount,
            ]);
        }
    }
}
