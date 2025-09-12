<?php

namespace App\Http\Controllers;

use App\Interfaces\CoinPackageRepositoryInterface;
use App\Interfaces\SeriesEpisodeRepositoryInterface;
use App\Interfaces\SeriesRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    protected $seriesRepository;
    protected $seriesEpisodeRepository;
    protected $coinPackageRepository;

    public function __construct(
        SeriesRepositoryInterface $seriesRepository,
        SeriesEpisodeRepositoryInterface $seriesEpisodeRepository,
        CoinPackageRepositoryInterface $coinPackageRepository
    )
    {
        $this->seriesRepository = $seriesRepository;
        $this->seriesEpisodeRepository = $seriesEpisodeRepository;
        $this->coinPackageRepository = $coinPackageRepository;
    }

    public function show($slug)
    {
        $series = $this->seriesRepository->getBySlug($slug);
        $relatedSeries = $this->seriesRepository->getAll([
            'exclude_id' => $series->id,
            'genre_id' => $series->genre_id,
        ], 4);

        return view('pages.series.show', compact('series', 'relatedSeries'));
    }

    public function play($slug, $episodeId)
    {
        $series = $this->seriesRepository->getBySlug($slug);
        $episode = $this->seriesEpisodeRepository->getById($episodeId);
        $episodes = $this->seriesEpisodeRepository->getBySeriesId($series->id);
        $isUnlocked = $this->seriesEpisodeRepository->isUnlocked($episodeId);
        $coinPackages = $this->coinPackageRepository->getAll();

        // klo episode nya ke-lock dan user belum buka
        if (!$isUnlocked && $episode->is_locked) {
            $episode->video = null;
        }

        return view('pages.series.play', compact('series', 'episode', 'episodes', 'isUnlocked', 'coinPackages'));
    }

    public function streamVideo($episodeId)
    {
        // 1. Cari data episode berdasarkan ID
        $episode = $this->seriesEpisodeRepository->getById($episodeId);

        // Jika episode tidak ditemukan, kirim error 404
        if (!$episode || !$episode->video) {
            abort(404);
        }

        // 2. Cek apakah file video benar-benar ada di private storage
        if (!Storage::disk('local')->exists($episode->video)) {
            abort(404);
        }

        // 3. Ambil path file dan stream sebagai response
        // Method 'response()' dari Storage facade secara otomatis menangani
        // header yang diperlukan untuk streaming (Content-Type, Content-Length, dll.)
        return Storage::disk('local')->response($episode->video);
    }

    public function unlockEpisode($slug, $episodeId)
    {
        $success = $this->seriesEpisodeRepository->unlock($episodeId);

        if (!$success) {
            return redirect()->back()->with('error', 'Insufficient coin balance to unlock this episode.');
        }

        return redirect()->route('series.play', [
            'slug' => $slug,
            'episodeId' => $episodeId,
        ])->with('success', 'Episode unlocked successfully.');
    }
}
