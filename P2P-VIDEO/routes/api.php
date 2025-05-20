<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/video/event', function (Request $request) {
    $event = $request->event;
    $time = $request->time;
    $room_key = $request->room_key;
    
    $eventClass = "App\\Events\\$event";
    \Log::info("event: " . $event);
    \Log::info("time: " . $time);
    \Log::info("class: " . $eventClass);
    \Log::info("room_key: " . $room_key);
    if (class_exists($eventClass)) {
        broadcast(new $eventClass($room_key, $time))->toOthers();
        return response()->json(['status' => 'ok']);
    }
    return response()->json(['error'=> 'Invalid event'],400);
});
