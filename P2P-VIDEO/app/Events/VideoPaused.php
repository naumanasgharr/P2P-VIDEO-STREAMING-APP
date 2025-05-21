<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class VideoPaused implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public string $room_id;
    public float $time;
    public function __construct(string $room_id, float $time)
    {
        //
        $this->room_id = $room_id;
        $this->time = $time;
    }

    
    public function broadcastOn()
    {
        \Log::info("broadcasting VideoPaused room.".$this->room_id);
        return new Channel('room.' . $this->room_id);
    }
    
    public function broadcastAs() {
        return 'VideoPaused';
    }
}
