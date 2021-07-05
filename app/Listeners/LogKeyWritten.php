<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Events\UserIsOnline;
use Auth;
use Cache;

use App\Models\User;

class LogKeyWritten
{
    public $auth_id;
    
    public function __construct()
    {
        $this->auth_id = Auth::id();
    }

    
    public function handle($event)
    {
        if (Cache::has('user-active-' . $this->auth_id)){

            broadcast(new UserIsOnline($this->auth_id))->toOthers();

        }
    }
}



