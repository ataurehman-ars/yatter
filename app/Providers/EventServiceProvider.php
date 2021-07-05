<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\NewComment;
use App\Listeners\NewCommentNotify;

use App\Models\Comments;
use App\Observers\CommentsObserver;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        NewComment::class => [
            NewCommentNotify::class , 
        ],
        
        'Illuminate\Cache\Events\KeyWritten' => [
           'App\Listeners\LogKeyWritten',
       ],
        
    ];

    public function boot()
    {
        Comments::observe(CommentsObserver::class);
    }
}




