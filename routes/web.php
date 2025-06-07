<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

use App\Livewire\Admin\Meetups\ManageMeetups;
use App\Livewire\Admin\Users\ManageUsers; // Add this

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('meetups', ManageMeetups::class)->name('meetups.index');
    Route::get('users', ManageUsers::class)->name('users.index'); // New route for managing users
    // We can add more routes for create/edit later if not handled solely by Livewire component state
});

use App\Livewire\Public\MeetupList;

Route::get('meetups', MeetupList::class)->name('meetups.public.index');

require __DIR__.'/auth.php';
