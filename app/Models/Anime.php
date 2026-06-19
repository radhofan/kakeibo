<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    use HasFactory;

    protected $table = 'anime';

    protected $fillable = [
        'external_id',
        'slug',
        'title_romaji',
        'title_english',
        'title_native',
        'preferred_display_title',
        'synopsis',
        'cover_image_url',
        'banner_image_url',
        'format',
        'status',
        'episodes',
        'duration',
        'season',
        'season_year',
        'average_score',
        'popularity',
        'source',
        'age_rating',
        'metadata',
        'metadata_last_synced_at',
    ];

    protected function casts(): array
    {
        return [
            'metadata' => 'array',
            'metadata_last_synced_at' => 'datetime',
        ];
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function studios()
    {
        return $this->belongsToMany(Studio::class);
    }

    public function libraryEntries()
    {
        return $this->hasMany(LibraryEntry::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function listEntries()
    {
        return $this->hasMany(CustomListEntry::class);
    }

    public function people()
    {
        return $this->hasMany(AnimePerson::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
