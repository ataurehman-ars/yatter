<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Auth;
use DB;
use Exception;
use Cache;

use App\Models\Likes;
use App\Models\User;

use Illuminate\Support\Facades\Notification;
use App\Notifications\LikeDone;

class LikePost extends Component
{
    public $auth_id;
    public $post_id;
    public $username;
    public $photo_path;
    public $author_id;

    public function mount($post_id, $author_id)
    {
        $this->post_id = $post_id;
        $this->auth_id = Auth::id();
        $this->author_id = $author_id;
        $this->username = Auth::user()->username;
        $this->photo_path = Auth::user()->profile_photo_path;
    }

    public function render()
    {
        return view('livewire.like-post');
    }

    public function like_post()
    {
        try {

            if (!Likes::where('post_id' , $this->post_id)->where('liker_id' , $this->auth_id)->count() > 0){

                $like_added = Likes::firstOrCreate([
                    'post_id' => $this->post_id , 
                    'liker_id' => $this->auth_id , 
                    'liker_username' => $this->username , 
                    'liker_photo_path' => $this->photo_path ?? '', 
                ]);

                if ($like_added){
                    $this->emit('liked-' . $this->post_id , "liked");
                    $this->addCache();

                    if ($this->author_id !== $this->auth_id){

                        $user = User::where('id' , $this->author_id)->first();
                
                        Notification::send($user, 
                        new LikeDone($this->username, $this->photo_path, $this->post_id));
                    }

                    return;
                }
            }

            $unlike = Likes::where('post_id' , $this->post_id)->where('liker_id' , $this->auth_id)->delete();

            if ($unlike){
                $this->emit('liked-' . $this->post_id, "unliked");
                $this->removeCache();
                return;
            }
        }
        catch (Exception $e){

            dd($e);
        }
    }


    public function addCache()
    {
        try {

            $liked_posts = (array)json_decode(json_encode(Cache::get('likes-' . $this->auth_id)));

            // if (!count($liked_posts)){
            //     return;
            // }

            $obj = [
                "post_id" => $this->post_id , 
            ];

            array_push($liked_posts, (object)$obj);
            Cache::put('likes-' . $this->auth_id , $liked_posts, 60);
        }

        catch (Exception $e){
            return;
        }
    }

    public function removeCache()
    {
        $liked_posts = (array)json_decode(json_encode(Cache::get('likes-' . $this->auth_id)));

        $removed_ids = array_filter($liked_posts, function($a) {
            return $a->post_id !== $this->post_id;
        });

        Cache::put('likes-' . $this->auth_id , $removed_ids, 60);

    }
}


