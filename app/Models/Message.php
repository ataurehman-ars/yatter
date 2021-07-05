<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\NewMessage;

class Message extends Model
{
    protected $table = "messages";

    protected $fillable = [
        'sent_from' , 
        'sent_to' , 
        'message' , 
    ];


}




