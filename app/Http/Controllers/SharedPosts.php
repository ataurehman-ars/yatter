<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SharedPosts extends Controller
{
    public static function returnAllPosts()
    {
        $author_id = request()->get('author_id');

        return view('shared-posts' , [
            'author_id' => $author_id , 
        ]);
    }



}



