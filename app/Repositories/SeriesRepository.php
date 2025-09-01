<?php

namespace App\Repositories;

use App\Interfaces\SeriesRepositoryInterface;
use App\Models\Series;

class SeriesRepository implements SeriesRepositoryInterface
{
    public function getAll($filters = [], $limit = 10)
    {
        $query = Series::query()->with('genre');

        if (isset($filters['genre_id'])) {
            $query->where('genre_id', $filters['genre_id']);
        }

        if (isset($filters['is_trending'])) {
            $query->where('is_trending', $filters['is_trending']);
        }

        if (isset($filters['is_top_choice'])) {
            $query->where('is_top_choice', $filters['is_top_choice']);
        }

        return $query->get();
    }
}
