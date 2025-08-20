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

    protected static function boot()
    {
        parent::boot();

        // agar setiap query mendapatkan urutan berdasarkan display_order
        static::addGlobalScope('order', function ($query) {
            $query->orderBy('display_order');
        });

        // agar setiap kali membuat paket koin, display_order otomatis diatur
        static::creating(function ($package) {
            $package->display_order = (self::max('display_order') ?? 0) + 1;
        });

        // agar setiap kali menghapus paket koin, display_order yang lebih besar dari paket yang dihapus akan dikurangi
        static::deleting(function ($package) {
            self::where('display_order', '>', $package->display_order)
                ->decrement('display_order');
        });
    }

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
