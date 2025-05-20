<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoPlayed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $room_id;
    public $time;

    public function __construct($room_id,$time)
    {
        //
        $this->roomId = $room_id;
        $this->time = $time;
    }

    public function broadcastOn()
    {
        return new Channel("room." . $this->room_id);
    }

    public function broadcastAs() {
        return 'VideoPlayed';
    }
}
