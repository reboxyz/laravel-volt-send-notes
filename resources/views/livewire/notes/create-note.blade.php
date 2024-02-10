<?php

use Livewire\Volt\Component;

new class extends Component {
    public $title;
    public $body;
    public $recipient;
    public $send_date;

    public function submit()
    {
        $validated = $this->validate([
            'title' => ['required', 'string', 'min:5'],
            'body' => ['required', 'string', 'min:15'],
            'recipient' => ['required', 'email'],
            'send_date' => ['required', 'date', 'after_or_equal:today'],
        ]);

        auth()->user()->notes()->create(
            $validated
        );

        redirect(route('notes.index'));
    }
}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-input  wire:model='title' label='Title' placeholder="It's been a greet day" />
        <x-textarea  wire:model='body' label='Your Note' placeholder="Share your thoughts with your friend" />
        <x-input icon='user' wire:model='recipient' label='Recipient' placeholder="yourfriend@email.com" type='email' />
        <x-input icon='calendar' wire:model='send_date' type='date' label='Send Date' />
        <div class="pt-3">
            <x-button type='submit' primary right-icon='calendar' spinner>Schedule Note</x-button>
        </div>
        <x-errors />
    </form>
</div>
