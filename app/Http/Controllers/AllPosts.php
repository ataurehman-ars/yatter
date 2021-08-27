<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class AllPosts extends Controller
{
    public static function returnAllPosts()
    {
        $author_id = request()->get('author_id');

        $author_name = DB::table('users')->where('id' , $author_id)->select('username' , 'profile_photo_path')->get();

        return view('all-posts' , [
            'author_id' => $author_id , 
            'author_name' => $author_name[0]->username , 
            'author_photo_path' => $author_name[0]->profile_photo_path , 
        ]);
    }
}


