@extends('layouts.app')

@section('title', $list->exists ? 'Edit List' : 'Create List')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">{{ $list->exists ? 'Edit List' : 'Create List' }}</h1>
        <form method="POST" action="{{ $list->exists ? route('lists.update', $list) : route('lists.store') }}" class="space-y-5 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            @csrf
            @if ($list->exists) @method('PATCH') @endif
            <label class="block"><span class="text-sm font-bold">Title</span><input name="title" value="{{ old('title', $list->title) }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2"></label>
            <label class="block"><span class="text-sm font-bold">Description</span><textarea name="description" rows="4" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">{{ old('description', $list->description) }}</textarea></label>
            <select name="visibility" class="rounded-md border border-white/10 bg-zinc-900 px-3 py-2">
                @foreach (['public' => 'Public', 'unlisted' => 'Unlisted', 'private' => 'Private'] as $value => $label)
                    <option value="{{ $value }}" @selected(old('visibility', $list->visibility ?: 'public') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($anime as $item)
                    <label class="flex gap-3 rounded-md border border-white/10 p-3 text-sm">
                        <input type="checkbox" name="anime_ids[]" value="{{ $item->id }}" @checked($list->exists && $list->entries->pluck('anime_id')->contains($item->id))>
                        <span>{{ $item->preferred_display_title }}</span>
                    </label>
                @endforeach
            </div>
            @if ($errors->any())<div class="rounded-md bg-rose-500/10 p-3 text-sm text-rose-100">{{ $errors->first() }}</div>@endif
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save List</button>
        </form>
    </section>
@endsection
