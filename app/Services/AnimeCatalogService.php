<?php

namespace App\Services;

use App\Models\Anime;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AnimeCatalogService
{
    private array $genreIdsBySlug = [];

    public function cachePopular(int $page = 1): array
    {
        $query = <<<'GRAPHQL'
        query ($page: Int) {
          Page(page: $page, perPage: 15) {
            media(type: ANIME, sort: POPULARITY_DESC) {
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

        return $this->fetchAndCache($query, ['page' => $page]);
    }

    public function searchAndCache(string $search, int $page = 1): array
    {
        $query = <<<'GRAPHQL'
        query ($search: String, $page: Int) {
          Page(page: $page, perPage: 15) {
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

        return $this->fetchAndCache($query, ['search' => $search, 'page' => $page]);
    }

    private function fetchAndCache(string $query, array $variables): array
    {
        $response = Http::timeout(8)->post('https://graphql.anilist.co', [
            'query' => $query,
            'variables' => $variables,
        ]);

        if (! $response->ok()) {
            return [];
        }

        $media = collect($response->json('data.Page.media', []));

        $this->cacheGenres($media);

        return $this->cacheMediaBatch($media);
    }

    private function cacheMediaBatch($media): array
    {
        $now = now();
        $animeRows = $media->map(function (array $item) use ($now) {
            $title = $item['title']['english'] ?: $item['title']['romaji'];

            return [
                'external_id' => (string) $item['id'],
                'slug' => Str::slug($title).'-'.$item['id'],
                'title_romaji' => $item['title']['romaji'] ?: $title,
                'title_english' => $item['title']['english'],
                'title_native' => $item['title']['native'],
                'preferred_display_title' => $title,
                'synopsis' => strip_tags($item['description'] ?? ''),
                'cover_image_url' => $item['coverImage']['extraLarge'] ?? $item['coverImage']['large'] ?? null,
                'banner_image_url' => $item['bannerImage'] ?? null,
                'format' => $item['format'],
                'status' => $item['status'],
                'episodes' => $item['episodes'],
                'duration' => $item['duration'],
                'season' => Str::lower((string) $item['season']),
                'season_year' => $item['seasonYear'],
                'average_score' => $item['averageScore'],
                'popularity' => $item['popularity'] ?? 0,
                'source' => $item['source'],
                'metadata' => json_encode($item),
                'metadata_last_synced_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        });

        Anime::query()->upsert(
            $animeRows->all(),
            ['external_id'],
            [
                'slug', 'title_romaji', 'title_english', 'title_native', 'preferred_display_title',
                'synopsis', 'cover_image_url', 'banner_image_url', 'format', 'status', 'episodes',
                'duration', 'season', 'season_year', 'average_score', 'popularity', 'source',
                'metadata', 'metadata_last_synced_at', 'updated_at',
            ],
        );

        $animeByExternalId = Anime::query()
            ->whereIn('external_id', $animeRows->pluck('external_id'))
            ->get()
            ->keyBy('external_id');

        $animeIds = $animeByExternalId->pluck('id');
        DB::table('anime_genre')->whereIn('anime_id', $animeIds)->delete();

        $genreRows = $media->flatMap(function (array $item) use ($animeByExternalId) {
            $anime = $animeByExternalId->get((string) $item['id']);

            return collect($item['genres'] ?? [])
                ->map(fn (string $name) => [
                    'anime_id' => $anime->id,
                    'genre_id' => $this->genreIdsBySlug[Str::slug($name)],
                ]);
        })->unique(fn (array $row) => $row['anime_id'].'-'.$row['genre_id']);

        if ($genreRows->isNotEmpty()) {
            DB::table('anime_genre')->insertOrIgnore($genreRows->all());
        }

        return $media
            ->map(fn (array $item) => $animeByExternalId->get((string) $item['id']))
            ->all();
    }

    private function cacheGenres(iterable $media): void
    {
        $genres = collect($media)
            ->flatMap(fn (array $item) => $item['genres'] ?? [])
            ->mapWithKeys(fn (string $name) => [Str::slug($name) => $name]);

        if ($genres->isEmpty()) {
            return;
        }

        $now = now();

        Genre::query()->upsert(
            $genres->map(fn (string $name, string $slug) => [
                'slug' => $slug,
                'name' => $name,
                'created_at' => $now,
                'updated_at' => $now,
            ])->values()->all(),
            ['slug'],
            ['name', 'updated_at'],
        );

        $this->genreIdsBySlug = Genre::query()
            ->whereIn('slug', $genres->keys())
            ->pluck('id', 'slug')
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

        $genreIds = collect($media['genres'] ?? [])
            ->map(fn (string $name) => $this->genreIdsBySlug[Str::slug($name)] ?? null)
            ->filter()
            ->values();

        $anime->genres()->sync($genreIds);

        return $anime;
    }
}
