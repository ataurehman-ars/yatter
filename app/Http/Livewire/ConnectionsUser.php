<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Auth;

class ConnectionsUser extends Component
{

    public $authId;
    public $listConnections;

    public function mount()
    {
        $this->authId = Auth::id();
        
        $this->listConnections = DB::table('connections_' . $this->authId)
        ->select('connection_id' , 'connection_name' , 'connection_username' , 'connection_photo_url')
        ->get();

        // foreach($ids as $id){

        //     $select_id = (int)$id->user_id === (int)$this->authId ? $id->connection_id : $id->user_id;
        //     $user = DB::table('users')->where('id' , $select_id)
        //     ->select('id' , 'name' , 'username' ,'email' , 'profile_photo_path')
        //     ->get();

        //     array_push($this->listConnections, (object)$user[0]);

        // }

    }

    public function render()
    {
        return view('livewire.connections-user');
    }


}



