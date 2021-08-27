<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use DB;

use App\Events\ChatDeleted;

class DeleteChat extends Component
{
    public $auth_id;
    public $receiver_id;

    public function mount($receiver_id)
    {
        $this->auth_id = Auth::id();
        $this->receiver_id = $receiver_id;
    }

    public function render()
    {
        return view('livewire.delete-chat');
    }

    public function deleteChat()
    {
        $ids = [$this->auth_id, $this->receiver_id];

        $deleted = DB::table('messages_' . $this->auth_id)
        ->whereIn('sent_from' , $ids)
        ->delete();

        if ($deleted){
            $this->emit('chat-deleted-' . $this->receiver_id);
            return;
        }
    }
}




