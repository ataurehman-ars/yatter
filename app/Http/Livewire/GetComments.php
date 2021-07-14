<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;

use Cache;
use Carbon\Carbon;


class GetComments extends Component
{

    public $postId;
    public $comments;
    public $filter;
    public $page_number;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->comments = [];
        $this->filter = 'all';
        $this->page_number = 0;
    }

    
    public function render()
    {
        return view('livewire.get-comments');
    }

    public function getListeners()
    {
        return [
            "filter-comments-{$this->postId}" => "filterComments" , 
        ];
    }

    public function filterComments($f, $p)
    {
        $this->filter = $f;
        $this->page_number = $p;
    }

    public function getComments()
    {
        $this->comments = 
        DB::table('comments')->where('post_id' , $this->postId)
        ->join('users' , function($join){
            $join->on('comments.author_id' , '=' , 'users.id');
        })
        ->select('users.id' , 'users.name' , 'users.username' , 
        'users.profile_photo_path' , 'comments.comment', 'comments.created_at')
        ->orderBy('comments.created_at' , 'desc')
        ->take(200)
        ->get();        
    }

}




