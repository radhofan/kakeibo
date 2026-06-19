<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Genre;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AnimeCatalogService
{
    public function searchAndCache(string $search, int $page = 1): array
    {
        $query = <<<'GRAPHQL'
        query ($search: String, $page: Int) {
          Page(page: $page, perPage: 12) {
            media(search: $search, type: ANIME, sort: POPULARITY_DESC) {
              id
              title { romaji english native }
              description(asHtml: false)
              coverImage { extraLarge large }
              bannerImage
              format
              status
              episodes
              duration
              season
              seasonYear
              averageScore
              popularity
              source
              genres
            }
          }
        }
        GRAPHQL;

        $response = Http::timeout(8)->post('https://graphql.anilist.co', [
            'query' => $query,
            'variables' => ['search' => $search, 'page' => $page],
        ]);

        if (! $response->ok()) {
            return [];
        }

        return collect($response->json('data.Page.media', []))
            ->map(fn (array $media) => $this->cacheMedia($media))
            ->all();
    }

    public function cacheMedia(array $media): Anime
    {
        $title = $media['title']['english'] ?: $media['title']['romaji'];
        $anime = Anime::query()->updateOrCreate(
            ['external_id' => (string) $media['id']],
            [
                'slug' => Str::slug($title).'-'.$media['id'],
                'title_romaji' => $media['title']['romaji'] ?: $title,
                'title_english' => $media['title']['english'],
                'title_native' => $media['title']['native'],
                'preferred_display_title' => $title,
                'synopsis' => strip_tags($media['description'] ?? ''),
                'cover_image_url' => $media['coverImage']['extraLarge'] ?? $media['coverImage']['large'] ?? null,
                'banner_image_url' => $media['bannerImage'] ?? null,
                'format' => $media['format'],
                'status' => $media['status'],
                'episodes' => $media['episodes'],
                'duration' => $media['duration'],
                'season' => Str::lower((string) $media['season']),
                'season_year' => $media['seasonYear'],
                'average_score' => $media['averageScore'],
                'popularity' => $media['popularity'] ?? 0,
                'source' => $media['source'],
                'metadata' => $media,
                'metadata_last_synced_at' => now(),
            ],
        );

        $genreIds = collect($media['genres'] ?? [])->map(function (string $name) {
            return Genre::query()->firstOrCreate(['slug' => Str::slug($name)], ['name' => $name])->id;
        });

        $anime->genres()->sync($genreIds);

        return $anime;
    }
}
