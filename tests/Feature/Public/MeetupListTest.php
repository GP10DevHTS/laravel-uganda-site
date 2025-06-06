<?php

namespace Tests\Feature\Public;

use App\Models\Meetup;
use App\Models\User;
use App\Livewire\Public\MeetupList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MeetupListTest extends TestCase
{
    use RefreshDatabase;

    
    public function public_meetups_page_can_be_accessed()
    {
        $this->get(route('meetups.public.index'))
            ->assertOk()
            ->assertSeeLivewire(MeetupList::class);
    }

    
    public function it_displays_a_list_of_meetups()
    {
        $user = User::factory()->create(); // Needed for meetup factory
        Meetup::factory()->count(5)->create(['user_id' => $user->id]);

        Livewire::test(MeetupList::class)
            ->assertSee(Meetup::first()->title);
    }

    
    public function it_displays_a_message_when_no_meetups_are_available()
    {
        Livewire::test(MeetupList::class)
            ->assertSee('No meetups scheduled at the moment.');
    }

    
    public function it_paginates_meetups()
    {
        $user = User::factory()->create();
        Meetup::factory()->count(15)->create(['user_id' => $user->id]); // Assuming pagination is 10

        Livewire::test(MeetupList::class)
            ->assertSee(Meetup::first()->title)
            ->assertDontSee(Meetup::orderBy('id', 'desc')->first()->title); // Last one shouldn't be on first page
    }
}
