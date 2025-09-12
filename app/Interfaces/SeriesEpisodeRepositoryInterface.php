<?php

namespace App\Interfaces;

interface SeriesEpisodeRepositoryInterface
{
    public function getById($id);
    public function getBySeriesId($seriesId);
    public function isUnlocked($episodeId);
    public function unlock($episodeId);
}
