<?php

namespace App\Listeners;

use App\Events\NewComment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Http\Livewire\GetComments;

class NewCommentNotify
{
    
    public function __construct()
    {
        
    }

    
    public function handle(NewComment $event)
    {
        
    }
}



