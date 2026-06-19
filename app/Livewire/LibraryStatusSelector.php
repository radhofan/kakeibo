<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\Anime;
use App\Models\LibraryEntry;
use Livewire\Component;

class LibraryStatusSelector extends Component
{
    public Anime $anime;

    public string $status = 'planned';

    public int $progress = 0;

    public ?int $userScore = null;

    public ?LibraryEntry $entry = null;

    public bool $showStatusOptions = false;

    public function mount(Anime $anime): void
    {
        $this->anime = $anime;

        if (auth()->check()) {
            $this->entry = auth()->user()->libraryEntries()->where('anime_id', $anime->id)->first();
            $this->status = $this->entry?->status ?? 'planned';
            $this->progress = $this->entry?->progress ?? 0;
            $this->userScore = $this->entry?->user_score;
        }
    }

    public function save(): void
    {
        if (! auth()->check()) {
            $this->redirectRoute('login', ['redirect' => request()->fullUrl()]);

            return;
        }

        $this->validate([
            'status' => ['required', 'in:watching,completed,planned,on-hold,dropped'],
            'progress' => ['required', 'integer', 'min:0'],
            'userScore' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $maxProgress = $this->anime->episodes;
        if ($maxProgress && $this->progress > $maxProgress) {
            $this->progress = $maxProgress;
        }

        $this->entry = LibraryEntry::updateOrCreate(
            ['user_id' => auth()->id(), 'anime_id' => $this->anime->id],
            [
                'status' => $this->status,
                'progress' => $this->progress,
                'user_score' => $this->userScore,
                'visibility' => auth()->user()->library_visibility,
            ],
        );

        Activity::create([
            'user_id' => auth()->id(),
            'activity_type' => $this->entry->wasRecentlyCreated ? 'library_added' : 'status_changed',
            'subject_type' => Anime::class,
            'subject_id' => $this->anime->id,
            'metadata' => ['anime' => $this->anime->preferred_display_title, 'status' => $this->status],
            'visibility' => auth()->user()->activity_visibility,
        ]);

        session()->flash('status', 'Library saved.');
    }

    public function incrementProgress(): void
    {
        if (! auth()->check()) {
            $this->redirectRoute('login', ['redirect' => request()->fullUrl()]);

            return;
        }

        $limit = $this->anime->episodes;
        $this->progress = $limit ? min($this->progress + 1, $limit) : $this->progress + 1;
        $this->save();
    }

    public function toggleStatusOptions(): void
    {
        if (! auth()->check()) {
            $this->redirectRoute('login', ['redirect' => request()->fullUrl()]);

            return;
        }

        $this->showStatusOptions = ! $this->showStatusOptions;
    }

    public function setStatus(string $status): void
    {
        if (! auth()->check()) {
            $this->redirectRoute('login', ['redirect' => request()->fullUrl()]);

            return;
        }

        if (! array_key_exists($status, LibraryEntry::STATUSES)) {
            return;
        }

        $this->status = $status;
        $this->showStatusOptions = false;
    }

    public function render()
    {
        return view('livewire.library-status-selector', [
            'statuses' => LibraryEntry::STATUSES,
        ]);
    }
}
