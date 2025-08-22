<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeriesEpisode extends Model
{
    protected $fillable = [
        'series_id',
        'episode_number',
        'title',
        'description',
        'video_url',
        'video',
        'is_locked',
        'unlock_cost',
    ];

    protected $casts = [
        'is_locked' => 'boolean',
        'unlock_cost' => 'integer',
    ];

    public function getIsLockedAttribute($value): bool
    {
        return (bool) $value;
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    public function unlockedEpisodes()
    {
        return $this->hasMany(UnlockedEpisode::class);
    }

    public function watchProgress()
    {
        return $this->hasMany(WatchProgress::class);
    }
}
