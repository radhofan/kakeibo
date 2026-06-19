@extends('layouts.app')

@section('title', $profile->public_name.' Reviews')

@section('content')
    <section class="mx-auto max-w-5xl px-4 py-10 sm:px-6">
        <h1 class="mb-6 text-4xl font-black">{{ $profile->public_name }} Reviews</h1>
        <div class="space-y-4">@foreach ($reviews as $review)<x-review-card :review="$review" />@endforeach</div>
        <div class="mt-8">{{ $reviews->links() }}</div>
    </section>
@endsection
