<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\NewComment;

class Comments extends Model
{
    // protected $dispatchesEvents = [
    //     'created' => NewComment::class , 
    // ];

    
    protected $table = "comments";

    protected $primaryKey = 'post_id';

    protected $fillable = [
        'author_id' , 
        'post_id' , 
        'comment' ,  
    ];
}



