<?php

namespace App\Providers;

use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\SeriesEpisodeRepositoryInterface;
use App\Interfaces\SeriesRepositoryInterface;
use App\Repositories\BannerRepository;
use App\Repositories\SeriesEpisodeRepository;
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
        $this->app->bind(SeriesEpisodeRepositoryInterface::class, SeriesEpisodeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
