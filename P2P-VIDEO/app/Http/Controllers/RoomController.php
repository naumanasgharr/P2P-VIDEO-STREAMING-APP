<?php

namespace App\Http\Controllers;

use App\Models\friendships;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Events\PartyEnded;

class RoomController extends Controller
{
    //
    public function index() {
        $id = auth()->user()->id;
        $files = Storage::disk('public')->files($id);
        $fileList = collect($files)->map(function($file) {
            return [
                'name' => basename($file),
                'url' => Storage::url($file),
            ];
        });

        return view("new_party", compact("fileList"));
        
    }

    public function party(Request $request) {
        $id = auth()->user()->id;
        $path = $request->query('url');
        $url = str_replace('}}','', $path);
        $room_key = Str::uuid();
        Room::create(['user1_id'=>$id,'video_path'=>$url,'room_key'=> $room_key]);
        return view('party',compact('url','room_key'));
    }

    public function endParty(Request $request) {
        $id = auth()->user()->id;
        $room_key = $request->query('uuid');
        \Log::info( $room_key);
        $success = Room::where('room_key',$room_key)->where('user1_id', $id)->delete();
        if(!$success) {
            return back()->with('error','you are not the initiator of this party');
        }    
        return view('dashboard');
    }

    public function leaveParty(Request $request) {
        $id = auth()->user()->id;
        $room_key = $request->query('uuid');
        $room = Room::where('room_key',$room_key)->first();
        if($room->user1_id == $id) {
            event(new PartyEnded($room_key));
            $room->delete();
        }
        else if($room->user2_id == $id) {
            $room->user2_id = null;
            $room->save();
        }
        return back()->with('success','left');
    }
}
