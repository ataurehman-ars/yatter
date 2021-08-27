<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Messages;

use DB;
use Crypt;
use Auth;

class InboxUser extends Component
{

    public $auth_id;
    public $collector;
    public $recents;

    public function mount()
    {
        $this->auth_id = Auth::id();
        $this->collector = [];
        $this->recents = [];
        $this->listRecents();
    }

    public function getListeners()
    {
        return [
            "echo-private:firstmessageto.{$this->auth_id},FirstMessage" => "listRecents" ,  
        ];
    }

    public function render()
    {
        return view('livewire.inbox-user');
    }

   

    public function listRecents()
    {
        $this->recents = DB::table('messages_' . $this->auth_id)
        ->where('sent_to' , $this->auth_id)
        ->orWhere('sent_from' , $this->auth_id)
        ->select('id' , 'sent_to' , 'sent_from' , 'message')
        ->orderBy('created_at' , 'desc')
        ->get();

        foreach($this->recents as $recent){

            $sent_from_own = $recent->sent_from === $this->auth_id;
            $sender_id = $sent_from_own ? $recent->sent_to : $recent->sent_from;
            $message = $recent->message;

            if(count($this->collector) && array_key_exists($sender_id, $this->collector))
                continue;
            

            $push_new = DB::table('users')
            ->where('id' , $sender_id)
            ->select('id' , 'username' , 'name', 'profile_photo_path')
            ->get();

            $to_arr = (array)$push_new[0];
            $to_arr['msg'] = $message;
            $to_arr['sent_from_own'] = $sent_from_own;

            $this->collector[$sender_id] = (object)$to_arr;
        }


    
    }


    
}





