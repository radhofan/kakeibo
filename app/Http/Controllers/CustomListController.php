<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use App\Models\CustomList;
use App\Models\CustomListLike;
use App\Models\SavedList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomListController extends Controller
{
    public function index(Request $request)
    {
        return view('lists.index', [
            'lists' => $request->user()->customLists()->with('entries.anime')->latest()->get(),
        ]);
    }

    public function publicShow(CustomList $customList)
    {
        abort_if($customList->visibility === 'private' && auth()->id() !== $customList->user_id, 404);

        return view('lists.show', ['list' => $customList->load(['user', 'entries.anime.genres', 'likes', 'saves'])]);
    }

    public function create()
    {
        return view('lists.form', ['list' => new CustomList, 'anime' => Anime::orderBy('preferred_display_title')->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:140'],
            'description' => ['nullable', 'string'],
            'visibility' => ['required', 'in:public,unlisted,private'],
            'anime_ids' => ['array'],
            'anime_ids.*' => ['exists:anime,id'],
        ]);

        $list = $request->user()->customLists()->create($data + [
            'slug' => Str::slug($data['title']).'-'.Str::lower(Str::random(5)),
            'is_ordered' => $request->boolean('is_ordered', true),
            'comments_enabled' => $request->boolean('comments_enabled', true),
        ]);

        foreach ($request->input('anime_ids', []) as $position => $animeId) {
            $list->entries()->create(['anime_id' => $animeId, 'position' => $position + 1]);
        }

        return redirect()->route('lists.show', $list)->with('status', 'List created.');
    }

    public function edit(CustomList $customList)
    {
        abort_unless($customList->user_id === auth()->id(), 403);

        return view('lists.form', [
            'list' => $customList->load('entries'),
            'anime' => Anime::orderBy('preferred_display_title')->get(),
        ]);
    }

    public function update(Request $request, CustomList $customList)
    {
        abort_unless($customList->user_id === $request->user()->id, 403);

        $data = $request->validate([
            'title' => ['required', 'string', 'max:140'],
            'description' => ['nullable', 'string'],
            'visibility' => ['required', 'in:public,unlisted,private'],
            'anime_ids' => ['array'],
            'anime_ids.*' => ['exists:anime,id'],
        ]);

        $customList->update($data + [
            'is_ordered' => $request->boolean('is_ordered', true),
            'comments_enabled' => $request->boolean('comments_enabled', true),
        ]);

        $customList->entries()->delete();
        foreach ($request->input('anime_ids', []) as $position => $animeId) {
            $customList->entries()->create(['anime_id' => $animeId, 'position' => $position + 1]);
        }

        return redirect()->route('lists.show', $customList)->with('status', 'List updated.');
    }

    public function destroy(Request $request, CustomList $customList)
    {
        abort_unless($customList->user_id === $request->user()->id, 403);

        $customList->delete();

        return redirect()->route('lists.index')->with('status', 'List deleted.');
    }

    public function like(Request $request, CustomList $customList)
    {
        $like = CustomListLike::where(['user_id' => $request->user()->id, 'custom_list_id' => $customList->id])->first();

        if ($like) {
            $like->delete();

            return back()->with('status', 'List unliked.');
        }

        CustomListLike::create(['user_id' => $request->user()->id, 'custom_list_id' => $customList->id]);

        return back()->with('status', 'List liked.');
    }

    public function save(Request $request, CustomList $customList)
    {
        $save = SavedList::where(['user_id' => $request->user()->id, 'custom_list_id' => $customList->id])->first();

        if ($save) {
            $save->delete();

            return back()->with('status', 'List removed from saved lists.');
        }

        SavedList::create(['user_id' => $request->user()->id, 'custom_list_id' => $customList->id]);

        return back()->with('status', 'List saved.');
    }
}
