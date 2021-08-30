<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function returnPost(Request $req)
    {
        $post_id = $req->get('post_id');
        $scroll_target = $req->get('comment_id') ?: "";

        //$post_contents = Posts::where('post_id' , $post_id)
        //->select('post' , 'created_at' , 'related_photo')
        //->get();

        $post_contents = DB::table('posts')->where('post_id' , $post_id)
        ->join('users', function($join){
            $join->on('posts.author_id' , '=' , 'users.id');
        })
        ->select('posts.post', 'posts.created_at' , 'posts.related_photo' , 
        'users.id', 'users.name' , 'users.username' , 'users.profile_photo_path')
        ->get();

        return view('view-post')
        ->with('post_id' , $post_id)
        ->with('post_contents' , $post_contents)
        ->with('comment_id' , $scroll_target);
    }
}


