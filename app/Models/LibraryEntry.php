<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryEntry extends Model
{
    public const STATUSES = [
        'watching' => 'Watching',
        'completed' => 'Completed',
        'planned' => 'Plan to Watch',
        'on-hold' => 'On Hold',
        'dropped' => 'Dropped',
    ];

    protected $fillable = [
        'user_id',
        'anime_id',
        'status',
        'progress',
        'user_score',
        'started_at',
        'completed_at',
        'rewatch_count',
        'is_rewatching',
        'is_favorite',
        'private_note',
        'visibility',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'date',
            'completed_at' => 'date',
            'is_rewatching' => 'boolean',
            'is_favorite' => 'boolean',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }

    public function statusLabel(): string
    {
        return self::STATUSES[$this->status] ?? ucfirst($this->status);
    }
}
