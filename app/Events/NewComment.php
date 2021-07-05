<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Comments;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $postId;
    public $comment;
    public $username;
    public $photo_url;

    public function __construct($postId, $username, $photo_url, $comment)
    {
        $this->postId = $postId;
        $this->username = $username;
        $this->photo_url = $photo_url;
        $this->comment = $comment;
    }

    
    public function broadcastOn()
    {
        return new PrivateChannel('newcomment.'.$this->postId);
    }
}





