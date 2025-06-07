<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Livewire\Admin\Users\ManageUsers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserRoleManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        parent::tearDown();
        Livewire::flushState();
    }

    private function createAdmin(array $attributes = []): User
    {
        return User::factory()->create(array_merge(['is_admin' => true], $attributes));
    }

    private function createUser(array $attributes = []): User
    {
        return User::factory()->create(array_merge(['is_admin' => false], $attributes));
    }

    /** @test */
    public function non_admins_cannot_access_manage_users_page()
    {
        $user = $this->createUser();
        $this->actingAs($user)->get(route('admin.users.index'))
            ->assertForbidden();
    }

    /** @test */
    public function admins_can_access_manage_users_page()
    {
        $admin = $this->createAdmin();
        $this->actingAs($admin)->get(route('admin.users.index'))
            ->assertOk()
            ->assertSeeLivewire(ManageUsers::class);
    }

    /** @test */
    public function admin_can_make_another_user_an_admin()
    {
        $admin = $this->createAdmin();
        $userToPromote = $this->createUser(['is_admin' => false]);

        Livewire::actingAs($admin)
            ->test(ManageUsers::class)
            ->call('toggleAdminStatus', $userToPromote->id);

        $this->assertTrue((bool) $userToPromote->fresh()->is_admin);
    }

    /** @test */
    public function admin_can_revoke_admin_status_from_another_admin()
    {
        $admin = $this->createAdmin();
        $anotherAdmin = $this->createAdmin(['name' => 'Another Admin Test', 'email' => 'anotheradmin@example.com']);

        $this->assertGreaterThan(1, User::where('is_admin', true)->count(), "Test setup: Should have more than one admin to revoke status.");

        Livewire::actingAs($admin)
            ->test(ManageUsers::class)
            ->call('toggleAdminStatus', $anotherAdmin->id);

        $this->assertFalse((bool) $anotherAdmin->fresh()->is_admin);
    }

    /** @test */
    public function admin_cannot_revoke_their_own_admin_status()
    {
        $admin = $this->createAdmin();

        Livewire::actingAs($admin)
            ->test(ManageUsers::class)
            ->call('toggleAdminStatus', $admin->id)
            ->assertSessionHas('error', 'You cannot change your own admin status.');

        $this->assertTrue((bool) $admin->fresh()->is_admin);
    }

    /** @test */
    public function admin_cannot_revoke_status_of_the_last_admin()
    {
        User::query()->delete();
        $admin1 = $this->createAdmin(['name' => 'Admin One', 'email' => 'admin1@example.com']);
        $admin2 = $this->createAdmin(['name' => 'Admin Two', 'email' => 'admin2@example.com']);
        $this->assertEquals(2, User::where('is_admin', true)->count());

        Livewire::actingAs($admin1)
            ->test(ManageUsers::class)
            ->call('toggleAdminStatus', $admin2->id); // Demote admin2
        $this->assertFalse((bool) $admin2->fresh()->is_admin);
        $this->assertTrue((bool) $admin1->fresh()->is_admin);
        $this->assertEquals(1, User::where('is_admin', true)->count());

        // Now, admin1 (who is the last admin) tries to demote themselves. Should be blocked by self-demotion rule.
        Livewire::actingAs($admin1)
            ->test(ManageUsers::class)
            ->call('toggleAdminStatus', $admin1->id)
            ->assertSessionHas('error', 'You cannot change your own admin status.');
        $this->assertTrue((bool) $admin1->fresh()->is_admin);
        $this->assertEquals(1, User::where('is_admin', true)->count());

        // Now, admin1 (last admin) tries to make user an admin (which is fine)
        $someUser = $this->createUser(['email' => 'someuser@example.com']);
        Livewire::actingAs($admin1)
            ->test(ManageUsers::class)
            ->call('toggleAdminStatus', $someUser->id);
        $this->assertTrue((bool) $someUser->fresh()->is_admin);
        $this->assertEquals(2, User::where('is_admin', true)->count());
    }

    /** @test */
    public function it_shows_users_in_the_list()
    {
        $admin = $this->createAdmin();
        $user1 = $this->createUser(['name' => 'User One', 'email' => 'userone@example.com']);
        $user2 = $this->createUser(['name' => 'User Two', 'email' => 'usertwo@example.com']);

        Livewire::actingAs($admin)
            ->test(ManageUsers::class)
            ->assertSee($user1->name)
            ->assertSee($user2->name)
            ->assertSee($user1->email)
            ->assertSee($user2->email);
    }
}
