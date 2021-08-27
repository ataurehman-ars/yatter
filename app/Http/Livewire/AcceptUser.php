<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Auth;

class AcceptUser extends Component
{

    public $userId;
    public $authId;
    public $req_username;
    public $req_name;
    public $req_photo_url;
    public $ack;
    public $reload_page;

    public function mount($userId, $req_username, $req_name , $req_photo_url)
    {
        $this->userId = $userId;
        $this->authId = Auth::id();
        $this->req_username = $req_username;
        $this->req_name = $req_name;
        $this->req_photo_url = $req_photo_url;
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
        $added_1 = DB::table('connections_' . $this->authId)->insert([
            'connection_id' => $this->userId , 
            'connection_name' => $this->req_name , 
            'connection_username' => $this->req_username ,
            'connection_photo_url' => $this->req_photo_url  
        ]);

        $added_2 = DB::table('connections_' . $this->userId)->insert([
            'connection_id' => Auth::id() , 
            'connection_name' => Auth::user()->name , 
            'connection_username' => Auth::user()->username  ,
            'connection_photo_url' => Auth::user()->profile_photo_path   
        ]);

        if ($added_1 && $added_2){

            $this->deleteRequest();
            $this->ack = "accepted";
        }
    }

    
}



