@extends('layouts.app')

@section('title', 'Report Submitted')

@section('content')
    <section class="mx-auto max-w-3xl px-4 py-10 sm:px-6">
        <x-empty-state title="Report submitted.">Moderators can review it from the reports queue.</x-empty-state>
    </section>
@endsection
