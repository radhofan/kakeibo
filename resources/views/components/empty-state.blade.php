@props(['title', 'action' => null, 'href' => null])

<div class="rounded-lg border border-dashed border-white/20 bg-white/[0.03] p-8 text-center">
    <p class="text-lg font-black">{{ $title }}</p>
    @if ($slot->isNotEmpty())
        <div class="mx-auto mt-2 max-w-xl text-sm leading-6 text-zinc-400">{{ $slot }}</div>
    @endif
    @if ($action && $href)
        <a href="{{ $href }}" class="mt-5 inline-flex rounded-md bg-rose-600 px-4 py-2 text-sm font-bold text-white">{{ $action }}</a>
    @endif
</div>
