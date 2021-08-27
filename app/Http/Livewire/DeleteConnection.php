<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Auth;

class DeleteConnection extends Component
{
    public $authId;
    public $userId;
    public $reloadPage;

    public function mount($userId)
    {
        $this->authId = Auth::id();
        $this->userId = $userId;
        $this->reloadPage = false;
    }

    public function deleteConnection()
    {
        $delete_1 = DB::table('connections_' . $this->authId)->where(function($query){
            $query->where('connection_id' , $this->userId);
        })
        ->delete();

        $delete_2 = DB::table('connections_' . $this->userId)->where(function($query){
            $query->where('connection_id' , $this->authId);
        })
        ->delete();

        if ($delete_1 && $delete_2)
            $this->reloadPage = true;
    }
    
    public function render()
    {
        return view('livewire.delete-connection');
    }
}



