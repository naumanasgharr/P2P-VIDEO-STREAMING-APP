<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessage implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $room_key;
    public $username;
    public function __construct($room_key,$message,$username)
    {
        $this->message = $message;
        $this->room_key = $room_key;
        $this->username = $username;
    }

    public function broadcastOn()
    {
        
        return new Channel('send-message.' . $this->room_key);
    }

    public function broadcastAs() {
        return 'MessageReceived';
    }
}
