<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;
use DB;

class CountConnections extends Component
{
    public $auth_id;
    public $count_connections;

    public function mount($auth_id)
    {
        $this->auth_id = $auth_id;
        $this->count_connections  = DB::table('connections_' . $this->auth_id)->count();
        
    }

    public function render()
    {
        return view('livewire.count-connections');
    }
}


