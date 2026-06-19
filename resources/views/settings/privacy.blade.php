@extends('layouts.app')

@section('title', 'Privacy Settings')

@section('content')
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">Privacy Settings</h1>
        <form method="POST" action="{{ route('settings.privacy.update') }}" class="space-y-4 rounded-lg border border-white/10 bg-white/[0.04] p-5">
            @csrf @method('PATCH')
            @foreach (['profile_visibility' => 'Profile visibility', 'library_visibility' => 'Library visibility', 'activity_visibility' => 'Activity visibility'] as $field => $label)
                <label class="block"><span class="text-sm font-bold">{{ $label }}</span><select name="{{ $field }}" class="mt-1 w-full rounded-md border border-white/10 bg-zinc-900 px-3 py-2">@foreach (['public' => 'Public', 'followers' => 'Followers Only', 'private' => 'Private'] as $value => $text)<option value="{{ $value }}" @selected(auth()->user()->{$field} === $value)>{{ $text }}</option>@endforeach</select></label>
            @endforeach
            <button class="rounded-md bg-rose-600 px-5 py-3 text-sm font-black">Save Changes</button>
        </form>
    </section>
@endsection
