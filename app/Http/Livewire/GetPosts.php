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

    public function mount($auth_id='' , $auth_name='')
    {
        $this->auth_id = $auth_id ? $auth_id : Auth::id();
        $this->auth_name = $auth_name ? ($auth_name === Auth::user()->username ? 'You' : $auth_name) : 'You';
        $this->getPosts();
    }

    protected $listeners = [
        //'postAdded' => 'getPosts' , 
    ];


    public function render()
    {
        return view('livewire.get-posts');
    }

    public function getPosts()
    {
        $this->posts = 
        Posts::where('author_id' , $this->auth_id)
        ->select('post_id' , 'created_at' , 'post')
        ->orderBy('created_at' , 'desc')
        ->offset('0')
        ->limit('10')
        ->get();
    }
}


