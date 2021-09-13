<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Auth;

class AcceptUser extends Component
{

    public $userId;
    public $authId;

    public function mount($userId, $req_username)
    {
        $this->userId = $userId;
        $this->authId = Auth::id();
        $this->req_username = $req_username;
        $this->ack = '';
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
        return DB::table('requests')->where([
            'sent_to' => $this->authId , 
            'sent_from' => $this->userId
        ])
        ->delete();
    }

    public function makeConnection()
    {
        
    }

    
}



