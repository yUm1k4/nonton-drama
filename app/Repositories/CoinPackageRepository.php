<?php

namespace App\Repositories;

use App\Interfaces\CoinPackageRepositoryInterface;
use App\Models\CoinPackage;

class CoinPackageRepository implements CoinPackageRepositoryInterface
{

    public function getAll()
    {
        return CoinPackage::orderBy('display_order')->get();
    }
}
