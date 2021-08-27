<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use Crypt;
use DB;
use Auth;

use Carbon\Carbon;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Messages;

class ListCaches extends Controller
{
    public static function getCaches()
    {
        
    }
}




