<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LoadFeed extends Component
{
    public $posts;

    public function mount()
    {
        $this->posts = [];
        $this->getPosts();
    }
    public function render()
    {
        return view('livewire.load-feed');
    }

    public function getPosts()
    {
        return  DB::table('posts')
        ->join('users' , function($join){
            $join->on('posts.author_id' , '=' , 'users.id');
        })
        ->select('users.id', 'users.username' , 'users.profile_photo_path' , 
        'posts.post_id' , 'posts.post', 'posts.created_at')
        ->orderBy('posts.created_at' , 'desc')
        ->offset('0')
        ->limit('20')
        ->get();
    }
}
