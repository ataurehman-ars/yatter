<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Posts;
use Auth;

class GetPosts extends Component
{

    public $auth_id;
    public $auth_name;
    public $posts = array();
    public $offset;
    public $limit;

    public function mount($auth_id='' , $auth_name='')
    {
        $this->auth_id = $auth_id ? $auth_id : Auth::id();
        $this->auth_name = $auth_name ? ($auth_name === Auth::user()->username ? 'You' : $auth_name) : 'You';
        $this->offset = 0;
        $this->limit = 10;
        $this->getPosts();
    }

    protected $listeners = [
        //'postAdded' => 'getPosts' , 
    ];


    public function render()
    {
        return view('livewire.get-posts');
    }

    public function olderPosts()
    {
        $this->offset = $this->limit + 1;
        $this->limit = $this->offset + 10;
        $this->getPosts();
    }

    public function getPosts()
    {
        $this->posts = 
        Posts::where('author_id' , $this->auth_id)
        ->select('post_id' , 'created_at' , 'post')
        ->orderBy('created_at' , 'desc')
        ->offset($this->offset)
        ->limit($this->limit)
        ->get();

        if (!count($this->posts)){
            $this->offset = 0;
            $this->limit = 10;
            $this->getPosts();
        }
    }
}


