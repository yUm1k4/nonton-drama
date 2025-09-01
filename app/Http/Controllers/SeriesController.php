<?php

namespace App\Http\Controllers;

use App\Interfaces\SeriesRepositoryInterface;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    protected $seriesRepository;

    public function __construct(SeriesRepositoryInterface $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
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
}
