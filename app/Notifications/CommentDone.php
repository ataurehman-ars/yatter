<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class CommentDone extends Notification
{
    use Queueable;

    public $username;
    public $photo_path;
    public $post_id;
    public $comment_key;
    
    public function __construct($username , $photo_path , $post_id, $comment_key)
    {
        $this->username = $username;
        $this->photo_path = $photo_path;
        $this->post_id = $post_id;
        $this->comment_key = $comment_key;
    }

    
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    
    // public function toArray($notifiable)
    // {
    //     return ([
    //         'username' => $this->username,
    //         'user_id' => $this->user_id,
    //         'post_id' => $this->post_id , 
    //     ]);
    // }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'username' => $this->username,
            'photo_path' => $this->photo_path, 
            'post_id' => $this->post_id , 
            'comment_key' => $this->comment_key , 
        ]);
    }



    public function broadcastType()
    {
        return 'comment';
    }
}



