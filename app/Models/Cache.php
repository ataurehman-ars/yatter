<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\UserIsOffline;
use Auth;

class Cache extends Model
{

    protected $table = 'cache';

    protected $dispatchesEvents = [
        'deleted' => UserIsOffline::class  , 
    ];

    protected $primaryKey = "key";

    protected $fillable = [
        'value' , 
        'expiration' ,
    ];


}


