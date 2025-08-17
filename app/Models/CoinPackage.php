<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoinPackage extends Model
{
    protected $fillable = [
        'title',
        'coin_amount',
        'bonus_amount',
        'price',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'coin_amount' => 'integer',
        'bonus_amount' => 'integer',
        'price' => 'decimal:2',
        'display_order' => 'integer',
    ];

    /**
     * Check if the coin package is active.
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->is_active;
    }

    public function topUps()
    {
        return $this->hasMany(CoinTopUp::class);
    }
}
