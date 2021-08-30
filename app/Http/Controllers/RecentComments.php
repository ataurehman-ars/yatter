<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use Cache;
use Carbon\Carbon;
use Exception;

class RecentComments extends Controller
{
    public static function getRecentComments($post_id)
    {

        $recent_exists = Cache::get('recent-comments-' . $post_id);

        if ($recent_exists && count($recent_exists)){

            return view('view-comments' , [
                'comments' => $recent_exists , 
                'post_id' => $post_id , 
            ]);
        }

        $recent_comments = 
        DB::table('comments')->where('post_id' , $post_id)
        ->join('users' , function($join){
            $join->on('comments.author_id' , '=' , 'users.id');
        })
        ->select('users.id' , 'users.name' , 'users.username' , 
        'users.profile_photo_path' ,'comments.comment_id' , 'comments.comment', 'comments.created_at')
        ->orderBy('comments.created_at' , 'desc')
        ->take(20)
        ->get();

        Cache::put('recent-comments-' . $post_id , $recent_comments, Carbon::now()->addMinutes(45));

        return view('view-comments' , [
            'comments' => $recent_comments , 
            'post_id' => $post_id , 
        ]);
    }

}



