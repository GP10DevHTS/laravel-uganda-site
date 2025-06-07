<?php

namespace App\Livewire\Public;

use App\Models\Meetup;
use Livewire\Component;
use Livewire\WithPagination;

class MeetupList extends Component
{
    use WithPagination;

    public function render()
    {
        $meetups = Meetup::latest()->paginate(10); // Fetch latest meetups, paginated
        return view('livewire.public.meetup-list', [
            'meetups' => $meetups,
        ])->layout('components.layouts.app'); // Use the main app layout
    }
}
