@extends('layouts.app')

@section('content')
    <div class="mx-auto max-w-3xl space-y-6 p-6">
        <div>
            <p class="text-sm font-medium text-indigo-700">New recurring payment</p>
            <h1 class="mt-1 text-2xl font-bold">Add subscription</h1>
        </div>
        <form method="POST" action="{{ route('subscriptions.store') }}" class="space-y-5 rounded-xl border border-slate-200 bg-white p-6">
            @include('subscriptions._form', ['button' => 'Save subscription'])
        </form>
    </div>
@endsection
