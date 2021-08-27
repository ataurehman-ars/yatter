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

class ChatDeleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $auth_id;
    public $receiver_id;

    public function __construct($receiver_id)
    {
        $this->auth_id = Auth::id();
        $this->receiver_id = $receiver_id;
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel("chatdeleted-{$this->auth_id}.{$this->receiver_id}");
    }
}


