<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class SearchUser extends Component
{

    public $search;
    public $arr;


    public function mount()
    {
        $this->search = '';
        $this->arr = [];
    }

    public function render()
    {
        return view('livewire.search-user');
    }


    public function updatedSearch()
    {

        $search = $this->search;

        if (trim($search))
        {
            $this->arr = DB::table('users')
            ->where(function($query){
                $query->where('username' , 'like' , $this->search . '%');
            })
            ->orWhere(function($query){
                $query->where('name' , 'like' , $this->search . '%');
            })
            ->select('id' , 'name' , 'username' , 'email', 'profile_photo_path')
            ->offset(0)
            ->limit(10)
            ->orderBy('name', 'asc')
            ->get();

        }
    }
}


