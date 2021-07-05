<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use Auth;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $receiver_id;
    public $message;
    
    public function __construct($receiver_id, $message)
    {
        $this->receiver_id = $receiver_id;
        $this->message = $message;
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel('newmessageto.' . $this->receiver_id);
    }
}



