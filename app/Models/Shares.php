<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shares extends Model
{
    use HasFactory;

    protected $table = "shares";

    protected $fillable = [
        'sharer_id' , 
        'post_id' , 
        'author_id' , 
        'sharer_username' , 
        'author_username' , 
        'post' , 
        'related_photo' , 
    ];
}



