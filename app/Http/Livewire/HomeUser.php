<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cache;
use Auth;
use DB;
use Carbon\Carbon;

use App\Models\Likes;

class HomeUser extends Component
{
    public $my_likes;

    public function mount()
    {
        if (Cache::has("all-likes-" . Auth::id())){
            return;
        }

        $my_likes = DB::table('likes')->where('liker_id' , Auth::id())->select('post_id')->get();

        Cache::put("all-likes-" . Auth::id() , $my_likes , Carbon::now()->addMinutes(60));
    }
    public function render()
    {
        return view('livewire.home-user');
    }
}



