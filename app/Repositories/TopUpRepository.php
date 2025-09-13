<?php

namespace App\Repositories;

use App\Interfaces\TopUpRepositoryInterface;
use App\Models\CoinPackage;
use App\Models\CoinTopUp;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

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

        // config midtrans
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        // parameter yg akan dikirim ke midtrans nya
        $params = [
            'transaction_details' => [
                'order_id' => $topup->code,
                'gross_amount' => $topup->amount,
            ],
            'customer_details' => [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
            ],
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return $paymentUrl;
    }
}
