<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Shares;
use App\Models\User;

use Exception;
use DB;
use Auth;

use Illuminate\Support\Facades\Notification;
use App\Notifications\ShareDone;

class SharePost extends Component
{
    public $post_id;
    public $post_contents;

    public function mount($post_id, $post_contents)
    {
        $this->post_id = $post_id;
        $this->post_contents  = (array)$post_contents;
    }

    public function render()
    {
        return view('livewire.share-post');
    }

    public function share_post()
    {
        try {

            $already_shared = Shares::where('post_id' , $this->post_id)->where('sharer_id' , Auth::id())->count();

            if ($already_shared > 0){
                $this->emit('share-event-' . $this->post_id, 'Post already shared!');
                return;
            }

            $post_shared = Shares::firstOrCreate([
                'sharer_id' => Auth::id() , 
                'post_id' => $this->post_id , 
                'author_id' => $this->post_contents['id'] , 
                'sharer_username' => Auth::user()->username , 
                'author_username' => $this->post_contents['username'] , 
                'post' => $this->post_contents['post'] , 
                'related_photo' => $this->post_contents['related_photo'] , 
            ]);

            if ($post_shared){

                $this->emit('share-event-' . $this->post_id, 'You shared this post');
                $user = User::where('id' , $this->post_contents['id'])->first();
    
                Notification::send($user, 
                new ShareDone(Auth::user()->username , Auth::user()->profile_photo_path , $this->post_id));

                return;
            }
        }
        catch(Exception $e){
            dd('cant share post');
        }
    }
}


