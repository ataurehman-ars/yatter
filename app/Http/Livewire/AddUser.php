<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddUser extends Component
{
    public $userId;
    public $authId;
    public $status;
    public $connectText;
    public $cancelText;

    public function mount($userId, $authId)
    {
        $this->userId = $userId;
        $this->authId = $authId;
        $this->connectText = "Connect";
        $this->cancelText = "Cancel Request";
    }

    public function render()
    {
        return view('livewire.add-user');
    }

    public function checkIfConnection()
    {

        $if_conn = DB::table('connections')->where(function ($query) {
            $query->where('user_id', '=', $this->authId)->where('connection_id', '=', $this->userId);
        })
        ->orWhere(function ($query) {
            $query->where('user_id', '=', $this->userId)->where('connection_id', '=', $this->authId);
        })
        ->first();
        
        return $if_conn;
    }


    public function ifRequested()
    {
        $this->already_requested = 
        DB::table('requests')->where('sent_to' , $this->userId)->where('sent_from' , $this->authId)->first();

        $this->status = $this->already_requested ? $this->cancelText : $this->connectText;

        return $this->status;
    }

    public function addUser()
    {

        if ($this->status === $this->connectText){ 

            DB::table('requests')->insert([
                'sent_to' => $this->userId , 
                'sent_from' => $this->authId
            ]);
        }

        else if ($this->status === $this->cancelText)
            DB::table('requests')->where('sent_from' , $this->authId)->where('sent_to' , $this->userId)->delete();
        
    }
}


