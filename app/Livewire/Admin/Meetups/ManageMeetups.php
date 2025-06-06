<?php

namespace App\Livewire\Admin\Meetups;

use App\Models\Meetup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log; // For logging

class ManageMeetups extends Component
{
    use WithPagination;

    // public $meetups; // Removed as per previous subtask report
    public $selectedMeetupId;
    public $showModal = false;
    public $isEditMode = false;

    // Form fields
    public string $title = '';
    public string $description = '';
    public string $date = '';
    public string $time = '';
    public string $location = '';
    public ?string $image_url = null;
    public ?string $event_url = null;
    public bool $is_featured = false;

    protected function rules()
    {
        return [
            'title' => 'required|string|min:3|max:255',
            'description' => 'required|string|min:10',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:255',
            'event_url' => 'nullable|url|max:255',
            'is_featured' => 'required|boolean',
        ];
    }

    public function mount()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
        // $this->loadMeetups(); // loadMeetups will be called by render or explicitly - Removed
    }

    // private function loadMeetups() // Not strictly needed if render fetches directly - Removed
    // {
    //     // $this->meetups = Meetup::latest()->paginate(10);
    // }

    private function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->date = '';
        $this->time = '';
        $this->location = '';
        $this->image_url = null; // Changed from '' to null
        $this->event_url = null; // Changed from '' to null
        $this->is_featured = false;
        $this->selectedMeetupId = null;
        $this->isEditMode = false;
        $this->resetErrorBag();
    }

    public function create()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function edit($meetupId)
    {
        $meetup = Meetup::findOrFail($meetupId);
        $this->selectedMeetupId = $meetup->id;
        $this->title = $meetup->title;
        $this->description = $meetup->description;
        $this->date = $meetup->date->format('Y-m-d');
        $this->time = $meetup->time ? \Carbon\Carbon::parse($meetup->time)->format('H:i') : ''; // Handle null time
        $this->location = $meetup->location;
        $this->image_url = $meetup->image_url;
        $this->event_url = $meetup->event_url;
        $this->is_featured = (bool)$meetup->is_featured; // Ensure boolean
        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $meetupDataForEloquent = [
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'time' => $this->time . ':00', // Convert H:i form input to H:i:s for DB
            'location' => $this->location,
            'image_url' => $this->image_url ?: null, // Ensure null if empty
            'event_url' => $this->event_url ?: null, // Ensure null if empty
            'is_featured' => $this->is_featured ? 1 : 0, // Explicitly 1 or 0 for SQLite
            'user_id' => auth()->id(),
        ];

        Log::info('Saving meetup data: ', $meetupDataForEloquent);

        if ($this->isEditMode && $this->selectedMeetupId) {
            $meetup = Meetup::findOrFail($this->selectedMeetupId);
            $meetup->update($meetupDataForEloquent);
            Log::info('Meetup updated: ' . $meetup->id);
        } else {
            $meetup = Meetup::create($meetupDataForEloquent);
            Log::info('Meetup created: ' . $meetup->id);
        }

        $this->showModal = false;
        // $this->loadMeetups(); // Data will be reloaded by render
        $this->resetForm();
    }

    public function delete($meetupId)
    {
        if (!auth()->user()->is_admin) { // Corrected auth check
            abort(403);
        }
        Meetup::findOrFail($meetupId)->delete();
        // $this->loadMeetups(); // Data will be reloaded by render
    }

    public function render()
    {
        $currentMeetups = Meetup::latest()->paginate(10);
        return view('livewire.admin.meetups.manage-meetups', [
            'allMeetups' => $currentMeetups
        ])->layout('components.layouts.app');
    }
}
