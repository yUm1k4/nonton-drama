<?php

namespace App\Providers;

use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\CoinPackageRepositoryInterface;
use App\Interfaces\SeriesEpisodeRepositoryInterface;
use App\Interfaces\SeriesRepositoryInterface;
use App\Interfaces\TopUpRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\BannerRepository;
use App\Repositories\CoinPackageRepository;
use App\Repositories\SeriesEpisodeRepository;
use App\Repositories\SeriesRepository;
use App\Repositories\TopUpRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(SeriesRepositoryInterface::class, SeriesRepository::class);
        $this->app->bind(SeriesEpisodeRepositoryInterface::class, SeriesEpisodeRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(CoinPackageRepositoryInterface::class, CoinPackageRepository::class);
        $this->app->bind(TopUpRepositoryInterface::class, TopUpRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
