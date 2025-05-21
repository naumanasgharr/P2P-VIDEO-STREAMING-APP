<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Http\Request;

Broadcast::routes(['middleware' => ['auth']]);
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('/dashboard', 'dashboard')
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
Route::get('manageFriends',[\App\Http\Controllers\FriendshipsController::class,'manageFriends'])->middleware(['auth', 'verified'])->name('manageFriends');
Route::view('uploadContent','upload_content')->middleware(['auth', 'verified'])->name('uploadContent');

//friend requests
Route::post('/sendRequest',[\App\Http\Controllers\FriendshipsController::class,'sendRequest'])->middleware(['auth', 'verified'])->name('sendRequest');
Route::get('/requestAccepted/{friendId}',[\App\Http\Controllers\FriendshipsController::class,'accepted'])->middleware(['auth', 'verified'])->name('requestAccepted');
Route::get('/requestRejected/{friendId}',[\App\Http\Controllers\FriendshipsController::class,'rejected'])->middleware(['auth', 'verified'])->name('requestRejected');
Route::get('/removeFriend/{friendId}',[\App\Http\Controllers\FriendshipsController::class,'removeFriend'])->middleware(['auth', 'verified'])->name('removeFriend');

//upload-manage-remove content
Route::post('/uploadContent',[\App\Http\Controllers\ContentController::class,'store'])->middleware(['auth','verified'])->name('contentUpload');
Route::get('/manageContent',[\App\Http\Controllers\ContentController::class,'manage'])->middleware(['auth', 'verified'])->name('manageContent');
Route::get('/removeContent',[\App\Http\Controllers\ContentController::class,'remove'])->middleware(['auth', 'verified'])->name('removeContent');

//start-party
Route::get('/newParty',[\App\Http\Controllers\RoomController::class,'index'])->middleware(['auth', 'verified'])->name('newParty');
Route::get('/party',[\App\Http\Controllers\RoomController::class,'party'])->middleware(['auth', 'verified'])->name('party');

Route::get('/endParty',[\App\Http\Controllers\RoomController::class,'endParty'])->middleware(['auth','verified'])->name('endParty');
Route::get('/leaveParty',[\App\Http\Controllers\RoomController::class,'leaveParty'])->middleware(['auth','verified'])->name('leaveParty');
 
//join party
Route::view('join_party','join_party')->middleware(['auth','verified'])->name('join_party');
Route::post('/joinParty',[\App\Http\Controllers\RoomController::class,'joinParty'])->middleware(['auth', 'verified'])->name('joinParty');
Route::get('/showParty',[\App\Http\Controllers\RoomController::class,'showParty'])->middleware(['auth', 'verified'])->name('showParty');

//messages
/*Route::post('/messages', function (Request $request) {
    $message = $request->input('message');
    //$room_key = $request->room_key;
    //$user = User::where('id', auth()->user()->id)->first();
    $username = auth()->user()->username;
    \Log::info('username: '. $username);
    //\Log::info('room_key: '. $room_key);
    \Log::info('message: '. $message);
    return back()->with('done','done');
})->middleware(['auth','verified'])->name('messages');*/
Route::post('/send-message',function (Request $request){
    $message = $request->message;
    $room_key = $request->room_key;
    $username = auth()->user()->username;
    \Log::info('key: '. $room_key .' message: '. $message);
    broadcast(new \App\Events\SendMessage($room_key,$message,$username))->toOthers();
})->middleware(['auth','verified'])->name('send-message');

require __DIR__.'/auth.php';
