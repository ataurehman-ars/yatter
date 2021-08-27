<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

use App\Events\TestEvent;

class Messages extends Model
{
    protected $table = null;

    public function setTable($tableName)
    {
        $this->table = $tableName;
    }

    protected $dispatchesEvents = [
        'created' => TestEvent::class , 
    ];

}



