<?php

namespace App\Http\Controllers;

use App\Interfaces\BannerRepositoryInterface;
use App\Interfaces\SeriesRepositoryInterface;

class HomeController extends Controller
{
    protected $bannerRepository;
    protected $seriesRepository;

    public function __construct(
        BannerRepositoryInterface $bannerRepository,
        SeriesRepositoryInterface $seriesRepository
    )
    {
        $this->bannerRepository = $bannerRepository;
        $this->seriesRepository = $seriesRepository;
    }

    public function index()
    {
        $banners = $this->bannerRepository->getAll();
        $trendingSeries = $this->seriesRepository->getAll(['is_trending' => true]);

        return view('pages.home', compact('banners', 'trendingSeries'));
    }

}
