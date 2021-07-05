<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\QueryException  as QE;

class ShowChat extends Component
{
    public $auth_id;
    public $other_id;
    public $messages;

    public function mount($auth_id, $other_id)
    {
        $this->auth_id = $auth_id;
        $this->other_id = $other_id;
        $this->messages = [];
        $this->showMessages();
    }

    public function getListeners()
    {
        
    }

    public function render()
    {
        return view('livewire.show-chat');
    }

    public function showMessages()
    {
        try {
            $this->messages = DB::table('messages_' . $this->auth_id)
            ->where('sent_to' , $this->auth_id)->where('sent_from' , $this->other_id)
            ->orWhere(function($query){
                $query->where('sent_to' , $this->other_id)->where('sent_from' , $this->auth_id);
            })
            ->select('sent_to' , 'sent_from' , 'message', 'created_at')
            ->orderBy('created_at' , 'desc')
            ->take(15)
            ->get();

            $this->emit('lastMsg');

        }

        catch(QE $e){

            $this->messages = [];
            return;
        }
    }

}



