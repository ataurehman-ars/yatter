<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;

class UserActiveStatus extends Component
{
    public $userId;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function getListeners()
    {
        return [
            "echo-private:connectionactive.{$this->userId},UserIsOnline" => 'showActive' , 
        ];
    }
    public function render()
    {
        return view('livewire.user-active-status');
    }

    public function showActive()
    {
        $this->emit('user-online-' . $this->userId);
    }
}



