<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Posts;

class GetPosts extends Component
{

    public $authId;
    public $posts = array();

    public function mount($authId)
    {
        $this->authId = $authId;
        $this->getPosts();
    }

    protected $listeners = [
        'postAdded' => 'getPosts' , 
    ];


    public function render()
    {
        return view('livewire.get-posts');
    }

    public function getPosts()
    {
        $this->posts = 
        Posts::where('author_id' , $this->authId)
        ->select('post_id' , 'created_at' , 'post')
        ->orderBy('created_at' , 'desc')
        ->offset('0')
        ->limit('10')
        ->get();
    }
}


