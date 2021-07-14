<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectComments extends Component
{
    public $postId;
    public $recents;
    public $page_number;
    
    public function mount($postId, $page_number)
    {
        $this->postId = $postId;
        $this->recents = '';
        $this->page_number = $page_number;
    }

    public function render()
    {
        return view('livewire.select-comments');
    }

    public function updatedRecents()
    {
        $this->emit("filter-comments-" . $this->postId , $this->recents, $this->page_number);
    }
}
