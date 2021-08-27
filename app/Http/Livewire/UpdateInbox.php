<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Crypt;
use Auth;

class UpdateInbox extends Component
{
    public $auth_id;
    public $receiver_id;

    public function mount($receiver_id)
    {
        $this->auth_id = Auth::id();
        $this->receiver_id = $receiver_id;
    }

    public function getListeners()
    {
        return [
            "echo-private:newmessageto.{$this->auth_id}.{$this->receiver_id},NewMessage" => 'decryptMsg' , 
            "echo-private:newmessageto.{$this->receiver_id}.{$this->auth_id},NewMessage" => 'decryptMsg' , 
        ];
    }

    public function render()
    {
        return view('livewire.update-inbox');
    }

    public function decryptMsg($msg)
    {
        
        $decrypt = Crypt::decryptString($msg['message']);

        if ($msg['sender_id'] === $this->auth_id){
            $this->emit('sent-from-own-' . $msg['receiver_id'] ,  $decrypt);
            return;
        }
        
        $this->emit('msg-from-' . $msg['sender_id'] ,  $decrypt);

    }

}



