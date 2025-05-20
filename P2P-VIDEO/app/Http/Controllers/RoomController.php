<?php

namespace App\Http\Controllers;

use App\Models\friendships;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Events\PartyEnded;
use PhpParser\NodeVisitor\CommentAnnotatingVisitor;

class RoomController extends Controller
{
    // new party page
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

    //party page
    public function party(Request $request) {
        $id = auth()->user()->id;
        $path = $request->query('url');
        $url = str_replace('}}','', $path);
        $room_key = Str::uuid();
        Room::create(['user1_id'=>$id,'video_path'=>$url,'room_key'=> $room_key]);
        return view('party',compact('url','room_key'));
    }


    //join Party
    public function joinParty(Request $request) {
        $id = auth()->user()->id;
        $room_key = $request->input('uuid');

        \Log::info('key: '.$room_key);
        $room = Room::where('room_key',$room_key)->first();
        if(!$room) {
            return back()->with('error1','INVITE CODE IN INCORRECT');
        }
        if($room->user2_id != null) {
            return back()->with('error2','ROOM IS ALREADY FULL');
        }

        $room->user2_id = $id;
        $room->save();
        $url = $room->video_path;

        return redirect()->route('showParty',['url'=>$url,'room_key'=>$room_key]);
    }

    //redirecting to party page
    public function showParty(Request $request) {
        $url = $request->query('url');
        $room_key = $request->query('room_key');
        \Log::info('room_key recieved: '.$room_key);
        \Log::info('url recieved: '. $url);
        return view('party',compact('url','room_key'));
    }



    //end party
    public function endParty(Request $request) {
        $id = auth()->user()->id;
        $room_key = $request->query('uuid');
        \Log::info( $room_key);
        $success = Room::where('room_key',$room_key)->where('user1_id', $id)->delete();
        event(new PartyEnded($room_key));
        if(!$success) {
            return back()->with('error','you are not the initiator of this party');
        }    
        return view('dashboard');
    }

    //leave party
    public function leaveParty(Request $request) {
        $id = auth()->user()->id;
        $room_key = $request->query('uuid');
        $room = Room::where('room_key',$room_key)->first();
        if($room->user1_id == $id) {
            \Log::info("User1 is leaving. Firing PartyEnded for room: $room_key");
            event(new PartyEnded($room_key));
             \Log::info("Event should be fired.");
            $room->delete();
        }
        else if($room->user2_id == $id) {
            $room->user2_id = null;
            $room->save();
        }
        return view('dashboard');
    }
}
