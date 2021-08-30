<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class LoadFeed extends Component
{
    protected $listeners = ['load-more-content' => 'more_feed'];
    
    public $posts;
    public $offset;
    public $limit;
    public $counts;

    public function mount()
    {
        $this->posts = [];
        $this->counts = [];
        $this->offset = 0;
        $this->limit = 10;
        $this->getPosts();
    }

    public function render()
    {
        return view('livewire.load-feed');
    }

    public function more_feed()
    {
        $this->offset = $this->limit + 1;
        $this->limit = $this->offset + 10;
        $this->getPosts();
    }

    public function no_feed()
    {
        $this->offset = 0;
        $this->limit = 10;
        $this->getPosts();
    }

    public function getPosts()
    {
        $this->posts = DB::table('posts')
        ->join('users' , function($join){
            $join->on('posts.author_id' , '=' , 'users.id');
        })
        ->select('users.id', 'users.username' , 'users.profile_photo_path' , 
        'posts.post_id' , 'posts.post', 'posts.created_at', 'posts.related_photo')
        ->orderBy('posts.created_at' , 'desc')
        ->offset($this->offset)
        ->limit($this->limit)
        ->get();

        if (!count($this->posts)){
            $this->no_feed();
        }

        foreach($this->posts as $post)
        {
            $likes = DB::table('likes')->where('post_id' , $post->post_id)->count();
            $comments = DB::table('comments')->where('post_id' , $post->post_id)->count();
            $this->counts['post-' . $post->post_id] = (object)[ 'likes' => $likes , 'comments' => $comments];
        }

        $this->emit('scroll-top');
        
    }
}




