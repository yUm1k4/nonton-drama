<?php

namespace App\Repositories;

use App\Interfaces\SeriesEpisodeRepositoryInterface;
use App\Models\SeriesEpisode;
use App\Models\UnlockedEpisode;
use stdClass;

class SeriesEpisodeRepository implements SeriesEpisodeRepositoryInterface
{
    public function getById($id)
    {
        return SeriesEpisode::findOrFail($id);
    }

    public function getBySeriesId($seriesId)
    {
        $userId = auth()->id();

        $unlockedEpisodeIds = SeriesEpisode::query()
            ->join('unlocked_episodes', 'series_episodes.id', '=', 'unlocked_episodes.series_episode_id')
            ->where('series_episodes.series_id', $seriesId)
            ->where('unlocked_episodes.user_id', $userId)
            ->pluck('series_episodes.id');

        $episodes = SeriesEpisode::where('series_id', $seriesId)
            ->select('id', 'episode_number', 'is_locked')
            ->orderBy('episode_number')
            ->get();

        $results = $episodes->map(function ($episode) use ($unlockedEpisodeIds) {
            $isUnlockedForUser = !$episode->is_locked || $unlockedEpisodeIds->contains($episode->id);

            $episodeObject = new stdClass();
            $episodeObject->id = $episode->id;
            $episodeObject->episode_number = $episode->episode_number;
            $episodeObject->is_locked = $episode->is_locked;
            $episodeObject->is_unlocked_for_user = $isUnlockedForUser;

            return $episodeObject;
        });

        return $results;
    }

    public function isUnlocked($episodeId)
    {
        return UnlockedEpisode::where('user_id', auth()->id())
            ->where('series_episode_id', $episodeId)
            ->first();
    }
}
