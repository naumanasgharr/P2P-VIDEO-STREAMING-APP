<?php

namespace App\Events;

use App\Models\friendships;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FriendRequestSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $friendRequest;

    public function __construct(friendships $friendRequest)
    {
        //
        $this->friendRequest = $friendRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *

     */
    //      @return array<int, \Illuminate\Broadcasting\Channel>   
    public function broadcastOn(){
        return  new PrivateChannel('user.' . $this->friendRequest->friend_id);
    }

    public function broadcastAs(){
        return 'friend.request.sent';
    }
}
