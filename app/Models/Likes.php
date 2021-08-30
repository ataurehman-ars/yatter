<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $table = "likes";

    protected $primaryKey = "post_id";

    public $timestamps = false;

    protected $fillable = [
        'post_id' , 
        'liker_id' , 
        'liker_username' , 
        'liker_photo_path',
    ];

    protected $appends = [
        'liker_photo_path',
    ];

    protected $nullable = [
        'liker_photo_path',
    ];


    
}


