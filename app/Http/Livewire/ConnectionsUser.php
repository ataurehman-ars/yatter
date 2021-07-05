<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;


class ConnectionsUser extends Component
{

    public $authId;
    public $listConnections;

    public function mount($authId)
    {
        $this->authId = $authId;

        $this->listConnections = [];  
        
        $ids = DB::table('connections')
        ->where('user_id' , $this->authId)
        ->orWhere('connection_id' , $this->authId)
        ->select('user_id' , 'connection_id')
        ->get();

        foreach($ids as $id){

            $select_id = (int)$id->user_id === (int)$this->authId ? $id->connection_id : $id->user_id;
            $user = DB::table('users')->where('id' , $select_id)
            ->select('id' , 'name' , 'username' ,'email' , 'profile_photo_path')
            ->get();

            array_push($this->listConnections, (object)$user[0]);

        }


    }

    public function render()
    {
        return view('livewire.connections-user');
    }


}



