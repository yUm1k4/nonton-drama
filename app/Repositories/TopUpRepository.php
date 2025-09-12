<?php

namespace App\Repositories;

use App\Interfaces\TopUpRepositoryInterface;
use App\Models\CoinPackage;
use App\Models\CoinTopUp;
use Illuminate\Support\Str;

class TopUpRepository implements TopUpRepositoryInterface
{

    public function create(array $data)
    {
        $coinPackage = CoinPackage::find($data['coin_package']);

        $topup = CoinTopUp::create([
            'code' => 'TOPUP-' . Str::random(10),
            'user_id' => auth()->id(),
            'coin_package_id' => $coinPackage->id,
            'coin_amount' => $coinPackage->coin_amount + $coinPackage->bonus_amount,
            'amount' => $coinPackage->price,
        ]);

        return $topup;
    }
}
