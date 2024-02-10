<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    // State
    public $title;
    public $body;
    public $recipient;
    public $send_date;
    public $is_published;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);

        //$this->note = $note;
        $this->fill($note);
        
        $this->title = $note->title;
        $this->body = $note->body;
        $this->recipient = $note->recipient;
        $this->send_date = $note->send_date;
        $this->is_published = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'body' => ['required', 'string', 'min:15'],
            'recipient' => ['required', 'email'],
            'send_date' => ['required', 'date', 'after_or_equal:today'],
            'is_published' => ['boolean'],
        ]);

        $this->note->update($validated);

        //redirect(route('notes.index'));
        $this->dispatch('note-saved');
    }
}; ?>

<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-2xl mx-auto space-y-4 sm:px-6 lg:px-8">
        <form wire:submit='saveNote' class="space-y-4">
            <x-input wire:model="title" label="Note Title" placeholder="It's been a great day." />
            <x-textarea wire:model="body" label="Your Note"
                placeholder="Share all your thoughts with your friend." />
            <x-input icon="user" wire:model="recipient" label="Recipient" placeholder="yourfriend@email.com"
                type="email" />
            <x-input icon="calendar" wire:model="send_date" type="date" label="Send Date" />
            <x-checkbox label="Note Published" wire:model='is_published' />
            <div class="flex justify-between pt-4">
                <x-button type="submit" secondary spinner="saveNote">Save Note</x-button>
                <x-button href="{{ route('notes.index') }}" flat negative>Back to Notes</x-button>
            </div>
            <x-action-message on="note-saved" />
            <x-errors />
        </form>
    </div>
</div>
