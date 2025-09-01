<?php

namespace App\Http\Controllers;

use App\Interfaces\BannerRepositoryInterface;

class HomeController extends Controller
{
    protected $bannerRepository;

    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
         $this->bannerRepository = $bannerRepository;
    }

    public function index()
    {
        $banners = $this->bannerRepository->getAll();

        return view('pages.home', compact('banners'));
    }

}
