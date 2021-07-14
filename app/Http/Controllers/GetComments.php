<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

use DB;
use Cache;
use Carbon\Carbon;
use Exception;

class GetComments extends Controller
{

    public static function getCommentsView($post_id, $page_number=0)
    {
        $page = $page_number ? $page_number : (request()->get('page') ?: 1);

        $page_exists = Cache::get('comments-post-' . $post_id . '-page-' . $page);

        if ($page_exists && count($page_exists)){

            return view('view-comments' , [
                'comments' => $page_exists , 
                'post_id' => $post_id , 
                'page' => $page , 
            ]);
        }

        $comments = 
        DB::table('comments')->where('post_id' , $post_id)
        ->join('users' , function($join){
            $join->on('comments.author_id' , '=' , 'users.id');
        })
        ->select('users.id' , 'users.name' , 'users.username' , 
        'users.profile_photo_path' , 'comments.comment', 'comments.created_at')
        ->orderBy('comments.created_at' , 'desc')
        ->take(100);

        $paginate = $comments->paginate(15, ['*'] , 'page' , $page)->withPath('/view-post?post_id=' . $post_id);

        //Cache::put('all-comments-post-' . $post_id , json_encode($comments->paginate(15)), Carbon::now()->addMinutes(120));


        for ($i = 1 ; $i <= $paginate->lastPage()  ; $i++){
            Cache::put('comments-post-' . $post_id . '-page-' . $i , 
            $comments->paginate(15, ['*'] , 'page' ,  $i)
            ->withPath('/view-post?post_id=' . $post_id) , 
            Carbon::now()->addMinutes(45));
        }

        return view('view-comments' , [
            'comments' =>  $paginate , 
            'post_id' => $post_id , 
            'page' => $page , 
        ]);
        

    }
}


