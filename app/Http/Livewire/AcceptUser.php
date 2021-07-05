<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class AcceptUser extends Component
{

    public $userId;
    public $authId;
    public $req_username;
    public $ack;
    public $reload_page;

    public function mount($userId, $authId, $req_username)
    {
        $this->userId = $userId;
        $this->authId = $authId;
        $this->req_username = $req_username;
        $this->ack = '';
        $this->reload_page = false;
    }
    public function render()
    {
        return view('livewire.accept-user');
    }

    public function updateText()
    {
        return $this->ack ? $this->req_username . " is now your connection" : "Accept";
    }

    public function deleteRequest($reload=false)
    {
        DB::table('requests')->where([
            'sent_to' => $this->authId , 
            'sent_from' => $this->userId
        ])
        ->delete();

        if ($reload)
            $this->reload_page = true;
    }

    public function makeConnection()
    {
        $is_done = DB::table('connections')->insert([
            'user_id' => $this->authId , 
            'connection_id' => $this->userId
        ]);

        if ($is_done){

            $this->deleteRequest();
            $this->ack = "accepted";
        }
    }

    
}



