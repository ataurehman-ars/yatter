<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\TestEvent;

class Comments extends Model
{
    // protected $dispatchesEvents = [
    //     'created' => TestEvent::class , 
    // ];

    
    protected $table = "comments";

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'author_id' , 
        'post_id' , 
        'comment' ,  
    ];
}



