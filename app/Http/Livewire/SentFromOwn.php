<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Crypt;


class SentFromOwn extends Component
{
    public $receiver_id;

    public function mount($receiver_id)
    {
        $this->receiver_id = $receiver_id;
    }

    public function getListeners()
    {
        return [
            "echo-private:newmessageto.{$this->receiver_id},NewMessage" => 'decryptMsg' , 
        ];
    }

    public function render()
    {
        return view('livewire.sent-from-own');
    }

    public function decryptMsg($msg)
    {
        $decrypt = Crypt::decryptString($msg['message']);
        $this->emit('sent-from-own-' . $msg['receiver_id'] ,  $decrypt);

    }
}


