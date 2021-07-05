<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class CheckConnectionUser extends Component
{
    public $userId;
    public $authId;

    public function mount($userId, $authId)
    {
        $this->userId = $userId;
        $this->authId = $authId;
    }
    public function render()
    {
        return view('livewire.check-connection-user');
    }

    public function checkIfConnection()
    {
        $if_conn = DB::table('connections')->where('user_id' , $this->authId)->orWhere('connection_id' , $this->authId)
        ->where('user_id' , $this->userId)->orWhere('connection_id' , $this->userId)->first(); 

        return $if_conn;
    }
}
