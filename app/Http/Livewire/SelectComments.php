<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SelectComments extends Component
{
    public $postId;
    public $recents;
    public $page_number;
    public $category;
    
    public function mount($postId, $page_number)
    {
        $this->postId = $postId;
        $this->page_number = $page_number;
        $this->recents = 'recent';
        $this->category = '';
    }

    public function render()
    {
        return view('livewire.select-comments');
    }

    public function updatedRecents()
    {
        $this->category = $this->recents;
        $this->emit("filter-comments-" . $this->postId , $this->recents, $this->page_number);
    }
}
