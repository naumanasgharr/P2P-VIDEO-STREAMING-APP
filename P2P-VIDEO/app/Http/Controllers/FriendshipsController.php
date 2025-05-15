<?php

namespace App\Http\Controllers;

use App\Events\friendRequestSent;
use App\Models\friendships;
use Illuminate\Http\Request;
use App\Models\User;

class FriendshipsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sendRequest(Request $request)
    {
        //getting the user and friend ids
        $user_id = auth()->user()->id;
        $friend_id = $request->friend_id;
        \Log::info('User ID: ' . $user_id);
        \Log::info('Friend ID: ' . $friend_id);

        //making sure user doesnt send themselves a request
        if($user_id==$friend_id) {
            return back()->with("error1","You cannot send a request to yourself");
        }
        //making sure the friend exists
        if(!User::where("id", $friend_id)->exists()) {
            return back()->with("error2","Your friends ID is incorrect and doesnt exist");
        }

        //making sure a request already doesnt exist
        $existingrequest = friendships::where(function ( $query) use ($friend_id,$user_id) {
            $query->where("user_id", $user_id)
                ->where('friend_id', $friend_id)
                ->where('accepted', false);
        })
        ->orWhere(function ($query) use ($friend_id,$user_id) {
            $query->where('user_id', $friend_id)
            ->where('friend_id', $user_id)
            ->where('accepted', false);
        })->exists();

        if($existingrequest) {
            return back()->with('error3','You have already sent/recieved a request to/from your friend');
        }

        //creating freindship record in db and sending success response
        $request = friendships::create(['user_id'=>$user_id,'friend_id'=>$friend_id,'accepted'=>false]);
        
        //sending notification
        \Log::info('Broadcasting to : '. $friend_id);
        broadcast(new FriendRequestSent($request))->toOthers();
        
        return back()->with('success','Request has been sent successfully');


        
    }

    public function manageFriends() {
        $friendRequests = friendships::where('friend_id', auth()->id())
        ->where('accepted', false)
        ->with('user')
        ->get();

        $friends = friendships::where('user_id',auth()->id())->where('accepted',true)->with('friend')->get();

        return view('manage_friends', compact('friendRequests','friends'));
    }

    public function accepted(Request $request) {
        $user = auth()->user()->id;
        $friendID = $request->friendId;
        $updated = friendships::where('user_id',$friendID)->where('friend_id',$user)->where('accepted',false)->update(['accepted'=>true]);
        if($updated) {
            \Log::info('UPDATED');
            friendships::create(['user_id'=>$user,'friend_id'=>$friendID,'accepted'=>true]);
        }
        else {
            return back()->with('error','oops, something didnt work');
        }
        

        return back()->with('accepted','Friend has been added');
    }

    public function rejected(Request $request) {
        $user = auth()->user()->id;
        $friendID = $request->friendId;
        \Log::info('rejectuserid' . $user);
        \Log::info('rejectfriendid' . $friendID);
        friendships::where('user_id',$friendID)->where('friend_id',$user)->delete();
        return back()->with('rejected','Request Rejected');
    }

    public function removeFriend(Request $request) {
        $user = auth()->user()->id;
        $friendID = $request->friendId;
        friendships::where('user_id',$user)->where('friend_id',$friendID)->delete();
        friendships::where('user_id',$friendID)->where('friend_id',$user)->delete();
        return back()->with('removed','Removed friend');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(friendships $friendships)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(friendships $friendships)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, friendships $friendships)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(friendships $friendships)
    {
        //
    }
}
