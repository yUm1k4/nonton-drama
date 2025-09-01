<?php

namespace App\Providers;

use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\SeriesRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\SeriesRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
