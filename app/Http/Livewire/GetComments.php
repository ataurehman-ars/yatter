<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;


class GetComments extends Component
{

    public $postId;
    public $comments;


    public function mount($postId)
    {
        $this->postId = $postId;
        $this->comments = [];
        $this->getComments();
    }

    
    public function render()
    {
        return view('livewire.get-comments');
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
        ->get();
    }

}




