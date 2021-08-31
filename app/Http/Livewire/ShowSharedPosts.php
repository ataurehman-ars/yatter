<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class ShowSharedPosts extends Component
{
    public $author_id;
    public $shared_posts;

    public function mount($author_id)
    {
        $this->author_id = $author_id;
        $this->shared_posts = [];
        $this->get_shares();

    }

    public function render()
    {
        return view('livewire.show-shared-posts');
    }

    public function get_shares()
    {
        $this->shared_posts = DB::table('shares')->where('sharer_id' , $this->author_id)
        ->select('post_id' , 'sharer_username' , 'author_username' , 
        'post' , 'related_photo' , 'created_at')
        ->get();
    }
}


