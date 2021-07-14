<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Exception;

class LoopComments extends Component
{
    public $comments;
    public $post_id;
    public $page;

    public function mount($comments, $post_id, $page)
    {
        $this->comments = $comments;
        $this->post_id = $post_id;
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.loop-comments');
    }
    
}




