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

//button redirections
Route::view('addFriends','components.searchbar')->name('addFriends');
Route::view('manageFriends','manage_friends')->middleware(['auth', 'verified'])->name('manageFriends');
Route::view('uploadContent','upload_content')->middleware(['auth', 'verified'])->name('uploadContent');
Route::view('manageContent','manage_content')->middleware(['auth', 'verified'])->name('manageContent');
Route::view('newParty','new_party')->middleware(['auth', 'verified'])->name('newParty');
Route::view('joinParty','join_party')->middleware(['auth', 'verified'])->name('joinParty');

// sending a friend request to a user
Route::post('/sendRequest',[\App\Http\Controllers\FriendshipsController::class,'sendRequest'])->middleware(['auth', 'verified'])->name('sendRequest');

require __DIR__.'/auth.php';
