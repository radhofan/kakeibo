<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\Genre;
use App\Services\AnimeCatalogService;
use Illuminate\Http\Request;

class AnimeController extends Controller
{
    public function landing()
    {
        return view('anime.landing', [
            'trending' => Anime::with('genres')->orderByDesc('popularity')->take(6)->get(),
            'seasonal' => Anime::with('genres')->where('season_year', now()->year)->take(4)->get(),
            'reviews' => \App\Models\Review::with(['anime', 'user', 'likes', 'comments'])
                ->where('publication_status', 'published')
                ->where('moderation_status', 'visible')
                ->latest('published_at')
                ->take(3)
                ->get(),
        ]);
    }

    public function discover(Request $request, AnimeCatalogService $catalog)
    {
        $apiWarning = null;

        if ($request->filled('q')) {
            try {
                $catalog->searchAndCache($request->q);
            } catch (\Throwable) {
                $apiWarning = 'External anime search is unavailable, so cached results are shown.';
            }
        } elseif (! $request->filled(['genre', 'year', 'format', 'status', 'min_score'])) {
            $page = max(1, $request->integer('page', 1));
            $catalogPage = (int) ceil(($page * 12) / 50);

            if (Anime::count() < $page * 12) {
                try {
                    $catalog->cachePopular($catalogPage);
                } catch (\Throwable) {
                    $apiWarning = 'External anime search is unavailable, so cached results are shown.';
                }
            }
        }

        $anime = Anime::query()
            ->with('genres')
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('preferred_display_title', 'like', '%'.$request->q.'%')
                        ->orWhere('title_english', 'like', '%'.$request->q.'%')
                        ->orWhere('title_romaji', 'like', '%'.$request->q.'%');
                });
            })
            ->when($request->filled('genre'), function ($query) use ($request) {
                $query->whereHas('genres', fn ($genres) => $genres->where('slug', $request->genre));
            })
            ->when($request->filled('year'), fn ($query) => $query->where('season_year', $request->integer('year')))
            ->when($request->filled('format'), fn ($query) => $query->where('format', $request->format))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->when($request->filled('min_score'), fn ($query) => $query->where('average_score', '>=', $request->integer('min_score')))
            ->when($request->get('sort') === 'score', fn ($query) => $query->orderByDesc('average_score'))
            ->when($request->get('sort') === 'newest', fn ($query) => $query->orderByDesc('season_year'))
            ->when($request->get('sort') === 'oldest', fn ($query) => $query->orderBy('season_year'))
            ->when($request->get('sort') === 'title', fn ($query) => $query->orderBy('preferred_display_title'))
            ->when(! $request->filled('sort') || $request->get('sort') === 'popular', fn ($query) => $query->orderByDesc('popularity'))
            ->paginate(12)
            ->withQueryString();

        return view('anime.discover', [
            'anime' => $anime,
            'genres' => Genre::orderBy('name')->get(),
            'apiWarning' => $apiWarning,
        ]);
    }

    public function seasonal(Request $request)
    {
        $year = $request->integer('year') ?: now()->year;
        $season = $request->get('season', 'spring');

        return view('anime.seasonal', [
            'year' => $year,
            'season' => $season,
            'groups' => Anime::with('genres')
                ->where('season_year', $year)
                ->where('season', $season)
                ->orderByDesc('popularity')
                ->get()
                ->groupBy(fn (Anime $anime) => $anime->format ?: 'Other'),
        ]);
    }

    public function top(Request $request)
    {
        $category = $request->get('category', 'highest-rated');
        $query = Anime::with('genres');

        match ($category) {
            'most-popular' => $query->orderByDesc('popularity'),
            'trending' => $query->orderByDesc('metadata->trending'),
            'upcoming' => $query->where('status', 'not_yet_released')->orderByDesc('popularity'),
            default => $query->orderByDesc('average_score'),
        };

        return view('anime.top', [
            'category' => $category,
            'anime' => $query->take(20)->get(),
        ]);
    }

    public function show(Anime $anime)
    {
        $anime->load(['genres', 'studios', 'people', 'reviews' => fn ($query) => $query->where('publication_status', 'published')->where('moderation_status', 'visible'), 'reviews.user', 'reviews.likes', 'reviews.comments']);

        return view('anime.show', [
            'anime' => $anime,
            'libraryEntry' => auth()->check()
                ? auth()->user()->libraryEntries()->where('anime_id', $anime->id)->first()
                : null,
            'related' => Anime::whereKeyNot($anime->id)->inRandomOrder()->take(4)->get(),
            'activities' => \App\Models\Activity::with('user')
                ->where('subject_type', Anime::class)
                ->where('subject_id', $anime->id)
                ->latest()
                ->take(8)
                ->get(),
        ]);
    }

    public function search(Request $request, AnimeCatalogService $catalog)
    {
        $query = $request->get('q', '');
        $tab = $request->get('tab', 'anime');
        $apiWarning = null;

        if ($tab === 'anime' && $query) {
            try {
                $catalog->searchAndCache($query);
            } catch (\Throwable) {
                $apiWarning = 'External anime search is unavailable, so cached results are shown.';
            }
        }

        return view('anime.search', [
            'query' => $query,
            'tab' => $tab,
            'apiWarning' => $apiWarning,
            'anime' => Anime::with('genres')
                ->when($query, fn ($builder) => $builder->where('preferred_display_title', 'like', '%'.$query.'%'))
                ->orderByDesc('popularity')
                ->paginate(24, ['*'], 'anime_page')
                ->withQueryString(),
            'users' => \App\Models\User::query()
                ->when($query, fn ($builder) => $builder->where('username', 'like', '%'.$query.'%')->orWhere('display_name', 'like', '%'.$query.'%'))
                ->take(8)
                ->get(),
            'lists' => \App\Models\CustomList::with(['user', 'entries.anime'])
                ->where('visibility', 'public')
                ->when($query, fn ($builder) => $builder->where('title', 'like', '%'.$query.'%'))
                ->take(8)
                ->get(),
            'reviews' => \App\Models\Review::with(['anime', 'user', 'likes', 'comments'])
                ->where('publication_status', 'published')
                ->where('moderation_status', 'visible')
                ->when($query, fn ($builder) => $builder->where('headline', 'like', '%'.$query.'%'))
                ->take(8)
                ->get(),
        ]);
    }
}
