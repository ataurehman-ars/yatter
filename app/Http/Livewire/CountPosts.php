<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;
use DB;

class CountPosts extends Component
{
    public $auth_id;
    public $count_posts;

    public function mount($auth_id)
    {
        $this->auth_id = $auth_id;
        $this->count_posts  = DB::table('posts')->where('author_id' , $this->auth_id)->count();
        
    }

    public function render()
    {
        return view('livewire.count-posts');
    }
}


