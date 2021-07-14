<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use Crypt;
use DB;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ListCaches extends Controller
{
    public static function getCaches()
    {

        $all_comments = json_decode(Cache::get('all-comments-post-3'));

        print_r($all_comments->paginate(15, ['*'], 'page' , 2));
        
    }
}




