<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Events\MessageSeen;

class SendSeenEvent extends Component
{
    public $sender_id;
    public $receiver_id;

    public function mount($sender_id,  $receiver_id)
    {
        $this->sender_id  = $sender_id;
        $this->receiver_id =  $receiver_id;
    }

    public function getListeners()
    {
        return [
            "echo-private:messageseen.{$this->receiver_id}.{$this->sender_id},MessageSeen" => 'getMsgSeen' ,
            "message-seen" => "informMsgSeen" , 
        ];
    }


    public function render()
    {
        return view('livewire.send-seen-event');
    }

    public function getMsgSeen()
    {
        $this->emit('getMsgSeen-' . $this->receiver_id);
    }

    public function informMsgSeen()
    {
        broadcast(new MessageSeen($this->sender_id, $this->receiver_id))->toOthers();
    }

}



