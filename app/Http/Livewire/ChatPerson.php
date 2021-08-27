<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChatPerson extends Component
{
    public $collect;

    public function mount($collect)
    {
        $this->collect = (array)$collect;
    }

    public function render()
    {
        return view('livewire.chat-person');
    }
}
