<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id',
        'anime_id',
        'headline',
        'body',
        'score',
        'contains_spoilers',
        'comments_enabled',
        'publication_status',
        'published_at',
        'edited_at',
        'moderation_status',
    ];

    protected function casts(): array
    {
        return [
            'contains_spoilers' => 'boolean',
            'comments_enabled' => 'boolean',
            'published_at' => 'datetime',
            'edited_at' => 'datetime',
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

    public function likes()
    {
        return $this->hasMany(ReviewLike::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
