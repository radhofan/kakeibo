<div class="text-white">
    @guest
        <div class="flex items-center justify-between gap-3">
            <span class="text-xs font-semibold uppercase text-zinc-400">Library</span>
            <a href="{{ route('login', ['redirect' => request()->fullUrl()]) }}" class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Sign in to track</a>
        </div>
    @else
    @if (session('status'))
        <div class="mb-3 rounded-md border border-emerald-500/30 bg-emerald-950/50 px-3 py-2 text-sm font-medium text-emerald-200">{{ session('status') }}</div>
    @endif

    <div class="flex items-center justify-between gap-3">
        <span class="text-xs font-semibold uppercase text-zinc-400">Library status</span>
        <button wire:click="toggleStatusOptions" title="Change library status" class="rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm font-semibold text-white">
            {{ $statuses[$status] }}
        </button>
    </div>

    @if ($showStatusOptions)
        <div class="mt-2 grid grid-cols-2 gap-2">
            @foreach ($statuses as $value => $label)
                <button wire:click="setStatus('{{ $value }}')" class="rounded-md border px-3 py-2 text-left text-sm font-medium {{ $status === $value ? 'border-rose-500 bg-rose-600 text-white' : 'border-white/15 bg-zinc-900 text-zinc-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    @endif

    <div class="mt-3 grid grid-cols-2 gap-2">
        <label class="block min-w-0">
            <span class="text-xs font-semibold uppercase text-zinc-400">Progress</span>
            <input wire:model="progress" type="number" min="0" max="{{ $anime->episodes }}" class="mt-1 w-full appearance-none rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm text-white">
        </label>

        <label class="block min-w-0">
            <span class="text-xs font-semibold uppercase text-zinc-400">Score</span>
            <input wire:model="userScore" type="number" min="1" max="100" class="mt-1 w-full appearance-none rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm text-white placeholder:text-zinc-500" placeholder="--">
        </label>
    </div>

    <div class="mt-3 grid grid-cols-2 gap-2">
        <button wire:click="incrementProgress" class="rounded-md border border-white/15 bg-zinc-900 px-3 py-2 text-sm font-semibold text-zinc-100">+1 episode</button>
        <button wire:click="save" class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Save</button>
    </div>

    @error('progress')
        <p class="mt-2 text-sm text-rose-300">{{ $message }}</p>
    @enderror
    @endguest
</div>
