<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\Meetup;
use App\Livewire\Admin\Meetups\ManageMeetups;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class MeetupManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        parent::tearDown();
        Livewire::flushState();
    }

    private function createAdminUser()
    {
        return User::factory()->create(['is_admin' => true]);
    }

    private function createUser()
    {
        return User::factory()->create(['is_admin' => false]);
    }

    /** @test */
    public function non_admins_cannot_access_admin_meetups_page()
    {
        $user = $this->createUser();
        $this->actingAs($user);

        $this->get(route('admin.meetups.index'))
            ->assertForbidden();
    }

    /** @test */
    public function admins_can_access_admin_meetups_page()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        $this->get(route('admin.meetups.index'))
            ->assertOk()
            ->assertSeeLivewire(ManageMeetups::class);
    }

    /** @test */
    public function admin_can_see_list_of_meetups()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);
        Meetup::factory()->count(3)->create(['user_id' => $admin->id]);

        Livewire::test(ManageMeetups::class)
            ->assertSee(Meetup::first()->title);
    }

    /** @test */
    public function admin_can_create_a_meetup()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);

        Livewire::test(ManageMeetups::class)
            ->call('create')
            ->assertSet('isEditMode', false)
            ->assertSet('showModal', true)
            ->set('title', 'Super New Meetup')
            ->set('description', 'Description for super new meetup.')
            ->set('date', '2025-01-15')
            ->set('time', '11:30')      // H:i format
            ->set('location', 'Online')
            ->set('image_url', 'http://example.com/new_image.png')
            ->set('event_url', 'http://example.com/new_event')
            ->set('is_featured', true)
            ->call('save');

        $meetup = Meetup::where('title', 'Super New Meetup')->first();
        $this->assertNotNull($meetup, "Meetup was not created.");
        $this->assertEquals('Description for super new meetup.', $meetup->description);
        $this->assertEquals('2025-01-15', $meetup->date->format('Y-m-d'));
        $this->assertEquals('11:30:00', $meetup->time);
        $this->assertEquals('Online', $meetup->location);
        $this->assertEquals('http://example.com/new_image.png', $meetup->image_url);
        $this->assertEquals('http://example.com/new_event', $meetup->event_url);
        $this->assertEquals(1, $meetup->is_featured); // Check against 1 for true
        $this->assertEquals($admin->id, $meetup->user_id);
    }

    /** @test */
    public function admin_can_edit_a_meetup()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);
        $meetup = Meetup::factory()->create([
            'user_id' => $admin->id,
            'title' => 'Initial Edit Title',
            'description' => 'Initial Description',
            'date' => '2025-02-10',
            'time' => '15:00:00',
            'location' => 'Some Place',
            'image_url' => 'http://example.com/initial.png',
            'event_url' => 'http://example.com/initial_event',
            'is_featured' => false,
        ]);

        Livewire::test(ManageMeetups::class)
            ->call('edit', $meetup->id)
            ->assertSet('title', 'Initial Edit Title')
            ->set('title', 'Final Updated Title')
            ->set('description', 'Final Updated Description')
            ->set('date', '2025-02-20')
            ->set('time', '16:45') // H:i format
            ->set('location', 'New Place')
            ->set('is_featured', true)
            ->call('save');

        $updatedMeetup = Meetup::find($meetup->id);
        $this->assertNotNull($updatedMeetup, "Meetup was not found after edit.");
        $this->assertEquals('Final Updated Title', $updatedMeetup->title);
        $this->assertEquals('Final Updated Description', $updatedMeetup->description);
        $this->assertEquals('2025-02-20', $updatedMeetup->date->format('Y-m-d'));
        $this->assertEquals('16:45:00', $updatedMeetup->time);
        $this->assertEquals('New Place', $updatedMeetup->location);
        $this->assertEquals(1, $updatedMeetup->is_featured);
    }

    /** @test */
    public function admin_can_delete_a_meetup()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);
        $meetup = Meetup::factory()->create(['user_id' => $admin->id]);

        Livewire::test(ManageMeetups::class)
            ->call('delete', $meetup->id);

        $this->assertDatabaseMissing('meetups', ['id' => $meetup->id]);
    }

    /** @test */
    public function validation_fails_for_invalid_data_on_create()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);
        Livewire::test(ManageMeetups::class)
            ->call('create')
            ->set('title', '')
            ->set('description', 'Short')
            ->set('date', 'invalid-date')
            ->set('time', 'invalid-time')
            ->set('location', '')
            // ->set('is_featured', 'not-a-boolean') // 'is_featured' is boolean by default in component
            ->call('save')
            ->assertHasErrors([
                'title' => 'required',
                'description' => 'min',
                'date' => 'date_format',
                'time' => 'date_format',
                'location' => 'required',
                // 'is_featured' => 'boolean', // This rule will pass if not set, as it defaults to false
            ]);
    }

     /** @test */
    public function validation_fails_for_invalid_data_on_edit()
    {
        $admin = $this->createAdminUser();
        $this->actingAs($admin);
        $meetup = Meetup::factory()->create(['user_id' => $admin->id]);

        Livewire::test(ManageMeetups::class)
            ->call('edit', $meetup->id)
            ->set('title', '')
            ->set('description', 'Short')
            ->set('date', 'invalid')
            ->call('save')
            ->assertHasErrors(['title' => 'required', 'description' => 'min', 'date' => 'date_format']);
    }
}
