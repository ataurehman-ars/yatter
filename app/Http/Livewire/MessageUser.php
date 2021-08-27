<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use App\Events\NewMessage;
use App\Events\FirstMessage;

use DB;
use Carbon\Carbon;
use Cache;
use Session;

date_default_timezone_set('Asia/Karachi');

class MessageUser extends Component
{
    public $message;
    public $auth_id;
    public $receiver_id;
    public $count_msgs;
    public $first_msg;

    public function mount($auth_id, $receiver_id)
    {
        $this->message = '';
        $this->auth_id = $auth_id;
        $this->receiver_id = $receiver_id;
        $this->first_msg = true;
    }


    public function getListeners()
    {
        return [
           "echo-private:newmessageto.{$this->auth_id}.{$this->receiver_id},NewMessage" => 'decryptMsg' , 
        ];
    }

    public function render()
    {
        return view('livewire.message-user');
    }

    public function updatedMessage()
    {
        $message = $this->message;
    }


    public function save_into_sender()
    {
        $enc = Crypt::encryptString($this->message);

        DB::table('messages_' . $this->auth_id)
        ->insert([
            'sent_from' => $this->auth_id , 
            'sent_to' => $this->receiver_id , 
            'message' => $enc , 
            'created_at' => Carbon::now() 
        ]);

        return $enc;
    }

    public function save_into_receiver($enc)
    {
    
        DB::table('messages_' . $this->receiver_id)
        ->insert([
            'sent_from' => $this->auth_id , 
            'sent_to' => $this->receiver_id , 
            'message' =>  $enc, 
            'created_at' => Carbon::now() 
        ]);
        
        return true;
    }

    public function sendMessage()
    {
        if (strlen(trim($this->message))){

            
            $s = $this->save_into_sender();
            $r = $this->save_into_receiver($s);

            if ($s && $r){
                $this->emit('updateInterface', $this->message);
                $this->reset('message');

                if (!$this->first_msg){
                    broadcast(new NewMessage($this->receiver_id, $this->auth_id , $s));
                    return;
                }

                broadcast(new FirstMessage($this->receiver_id));
                broadcast(new NewMessage($this->receiver_id, $this->auth_id , $s));
                $this->first_msg = false;
                return;
            }
            
        }
    }

    public function decryptMsg($msg)
    {
        $decrypt = Crypt::decryptString($msg['message']);

        $this->emit('msg-encrypted-' . $this->receiver_id, $decrypt);
    }

}



