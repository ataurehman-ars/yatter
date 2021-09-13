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
    public $auth_id;
    public $my_likes;
    public $my_conns;
    public $likes_exist;
    public $conns_exist;

    public function mount()
    {
        $this->auth_id = Auth::id();

        $this->likes_exist = Cache::has("likes-" . $this->auth_id);
        $this->conns_exist = Cache::has("connections-" . $this->auth_id);

        if ($this->likes_exist && $this->conns_exist){
            return;
        }

        if (!$this->likes_exist){
            $this->my_likes = DB::table('likes')->where('liker_id' , $this->auth_id)->select('post_id')->get();
            Cache::put("likes-" . $this->auth_id , $this->my_likes , Carbon::now()->addMinutes(60));
        }

        if ($this->conns_exist){
            return;
        }

        $this->my_conns =  DB::table('connections_' . $this->auth_id)->select('connection_id')->get();
        Cache::put("connections-" . $this->auth_id , $this->my_conns , Carbon::now()->addMinutes(60));

        return;
    }

    public function render()
    {
        return view('livewire.home-user');
    }
}



