<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Anime;
use App\Models\LibraryEntry;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function home(Request $request)
    {
        $entries = $request->user()->libraryEntries()->with('anime.genres')->latest('updated_at')->get();

        return view('library.home', [
            'watching' => $entries->where('status', 'watching')->take(6),
            'recent' => $entries->take(6),
            'counts' => $entries->countBy('status'),
            'recommendations' => \App\Models\Anime::with('genres')
                ->whereNotIn('id', $entries->pluck('anime_id'))
                ->orderByDesc('average_score')
                ->take(6)
                ->get(),
            'activities' => Activity::with('user')->latest()->take(8)->get(),
        ]);
    }

    public function index(Request $request, ?string $status = null)
    {
        $entries = $request->user()->libraryEntries()
            ->with('anime.genres')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($request->filled('q'), fn ($query) => $query->whereHas('anime', fn ($anime) => $anime->where('preferred_display_title', 'like', '%'.$request->q.'%')))
            ->latest('updated_at')
            ->paginate(12)
            ->withQueryString();

        return view('library.index', [
            'entries' => $entries,
            'status' => $status,
            'statuses' => LibraryEntry::STATUSES,
        ]);
    }

    public function update(Request $request, LibraryEntry $libraryEntry)
    {
        abort_unless($libraryEntry->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'status' => ['required', 'in:watching,completed,planned,on-hold,dropped'],
            'progress' => ['required', 'integer', 'min:0'],
            'user_score' => ['nullable', 'integer', 'min:1', 'max:100'],
            'visibility' => ['required', 'in:public,followers,private'],
            'is_favorite' => ['nullable', 'boolean'],
        ]);

        $libraryEntry->update($data + ['is_favorite' => $request->boolean('is_favorite')]);

        Activity::create([
            'user_id' => $request->user()->id,
            'activity_type' => 'status_changed',
            'subject_type' => \App\Models\Anime::class,
            'subject_id' => $libraryEntry->anime_id,
            'metadata' => ['status' => $libraryEntry->status],
            'visibility' => $libraryEntry->visibility,
        ]);

        return back()->with('status', 'Library entry updated.');
    }

    public function bulk(Request $request)
    {
        $data = $request->validate([
            'entry_ids' => ['required', 'array'],
            'entry_ids.*' => ['integer', 'exists:library_entries,id'],
            'bulk_action' => ['required', 'in:status,privacy,remove,favorite'],
            'status' => ['nullable', 'in:watching,completed,planned,on-hold,dropped'],
            'visibility' => ['nullable', 'in:public,followers,private'],
        ]);

        $entries = $request->user()->libraryEntries()->whereIn('id', $data['entry_ids']);

        match ($data['bulk_action']) {
            'status' => $entries->update(['status' => $data['status']]),
            'privacy' => $entries->update(['visibility' => $data['visibility']]),
            'favorite' => $entries->update(['is_favorite' => true]),
            'remove' => $entries->delete(),
        };

        Activity::create([
            'user_id' => $request->user()->id,
            'activity_type' => 'library_bulk_updated',
            'subject_type' => Anime::class,
            'subject_id' => null,
            'metadata' => ['action' => $data['bulk_action'], 'count' => count($data['entry_ids'])],
            'visibility' => 'private',
        ]);

        return back()->with('status', 'Bulk library action applied.');
    }

    public function destroy(Request $request, LibraryEntry $libraryEntry)
    {
        abort_unless($libraryEntry->user_id === $request->user()->id, 403);

        $libraryEntry->delete();

        return back()->with('status', 'Anime removed from your library.');
    }
}
