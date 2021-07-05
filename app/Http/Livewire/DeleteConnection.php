<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DeleteConnection extends Component
{
    public $authId;
    public $userId;
    public $reloadPage;

    public function mount($authId, $userId)
    {
        $this->authId = $authId;
        $this->userId = $userId;
        $this->reloadPage = false;
    }

    public function deleteConnection()
    {
        $delete = DB::table('connections')->where(function($query){
            $query->where('user_id' , $this->authId)->where('connection_id' , $this->userId);
        })
        ->orWhere(function($query){
            $query->where('user_id' , $this->userId)->where('connection_id' , $this->authId);
        })
        ->delete();

        if ($delete)
            $this->reloadPage = true;
    }
    
    public function render()
    {
        return view('livewire.delete-connection');
    }
}
