<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoinTopUp;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hashedkey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);


        if ($hashedkey !== $request->signature_key) {
            Log::warning('Invalid signature key for order_id: ' . $request->order_id);
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        $transaction = CoinTopUp::where('code', $orderId)->first();

        if (!$transaction) {
            Log::warning('Coin Top Up Not Found for order_id: ' . $orderId);
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        Log::info('Processing transaction status: ' . $transactionStatus . ' for order_id: ' . $orderId);
        Log::info('Midtrans Callback Request: ', $request->all());

        switch ($transactionStatus) {
            case 'capture':
                if ($request->payment_type == 'credit_card') {
                    if ($request->fraud_status == 'challenge') {
                        $transaction->update(['status' => 'pending']);
                    } else {
                        $transaction->update(['status' => 'success']);

                        $wallet = Wallet::where('user_id', $transaction->user_id)->first();
                        $wallet->increment('coin_balance', $transaction->coin_amount);
                    }
                }
                break;
            case 'settlement':
                $transaction->update(['status' => 'success']);

                $wallet = Wallet::where('user_id', $transaction->user_id)->first();
                $wallet->increment('coin_balance', $transaction->coin_amount);
                break;
            case 'pending':
                $transaction->update(['status' => 'pending']);
                break;
            case 'expire':
            case 'deny':
            case 'cancel':
                $transaction->update(['status' => 'failed']);
                break;
        }

        return response()->json(['message' => 'Callback received successfully'], 200);
    }
}
