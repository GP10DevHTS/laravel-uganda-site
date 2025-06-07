<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageUsers extends Component
{
    use WithPagination;

    public string $search = ''; // For search functionality

    public function mount()
    {
        if (!auth()->check() || !auth()->user()->is_admin) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function toggleAdminStatus($userId)
    {
        $user = User::findOrFail($userId);

        if (auth()->user() && auth()->user()->is($user)) {
            session()->flash('error', 'You cannot change your own admin status.');
            return;
        }

        // Last admin check: only if we are about to REVOKE admin status
        if ($user->is_admin) { // If user is currently an admin
            $adminCount = User::where('is_admin', true)->count();
            if ($adminCount <= 1) {
                session()->flash('error', 'Cannot remove the last admin. Please assign admin rights to another user first.');
                return;
            }
        }

        $user->is_admin = !$user->is_admin;
        $user->save();

        session()->flash('message', 'User admin status updated successfully.');
        // No explicit refresh needed, Livewire will re-render with updated data.
    }

    // Updated to use a different theme for pagination if needed, or default.
    // public function paginationView()
    // {
    //     return 'vendor.livewire.tailwind'; // Example, adjust if you have custom pagination views
    // }

    public function render()
    {
        $users = User::search($this->search)
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.admin.users.manage-users', [
            'users' => $users,
        ])->layout('components.layouts.app');
    }
}
