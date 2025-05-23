<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PartyEnded implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $roomKey;
    public function __construct($roomKey)
    {
        \Log::info("inside construct function PartyEnded");
        $this->roomKey = $roomKey;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     */
    public function broadcastOn()
    {
        \Log::info("broadcasting PartyEnded on ". $this->roomKey);
        return new Channel('party.' . $this->roomKey);
    }

    public function broadcastAs()
    {
        \Log::info('broadcast as function entered');
        return 'PartyEnded';
    }
}
