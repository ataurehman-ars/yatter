<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Comments;
use App\Events\NewComment;
use App\Models\User;
use DB;

use Illuminate\Database\QueryException as QE;

use Illuminate\Http\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentDone;

use Crypt;
use Auth;
use Cache;
use Exception;
use Carbon\Carbon;

use Illuminate\Encryption\Encrypter;


class AddComment extends Component
{
    
    public $authId;
    public $postId;
    public $comment;
    public $username;
    public $user;
    public $author_id;
    public $photo_path;

    public function mount($postId, $author_id)
    {
        $this->authId = Auth::id();
        $this->postId = $postId;
        $this->username = Auth::user()->username;
        $this->photo_path = Auth::user()->profile_photo_path;
        $this->author_id = $author_id;
        $this->comment = '';
    }

    public function render()
    {
        return view('livewire.add-comment');
    }

    public function updatedComment()
    {
        $comment = $this->comment;
    }

    public function addComment()
    {

        if (strlen(trim($this->comment))){

            try {

                // $cipher = 'AES-256-CBC';
                // $len = openssl_cipher_iv_length($cipher);
                // $iv = openssl_random_pseudo_bytes($len);
                // $key = base64_encode($iv);
                // $encrypt = openssl_encrypt($this->comment, $cipher, $key , $options=0, $iv );

                $encrypt = Crypt::encryptString($this->comment);

                $comment_added = Comments::create([
                    'author_id' => $this->authId , 
                    'post_id' => $this->postId , 
                    'comment' =>  $encrypt,
                ]);


                if($comment_added){
                    
                    broadcast(new NewComment($this->postId, Auth::user()->username, 
                    Auth::user()->profile_photo_path, $encrypt))->toOthers();

                    if ($this->author_id !== $this->authId){

                        $this->user = User::where('id' , $this->author_id)->first();
                
                        Notification::send($this->user, 
                        new CommentDone($this->username, $this->photo_path, $this->postId));
                    }

                    $this->emit('update-comment-section-' . $this->postId, $this->comment);
                    $this->addToCache($this->comment);
                    $this->comment = '';
                }

            }

            catch (QE $e){
                dd("Couldn't add comment");
            }

        }
    }


    public function addToCache($cmt)
    {
        try {

            $recent_comments = (array)json_decode(json_encode(Cache::get('recent-comments-' . $this->postId)));

            if (!count($recent_comments)){
                return;
            }

            $obj = [
                "id" => $this->authId , 
                "username" => Auth::user()->username , 
                "profile_photo_path" => Auth::user()->profile_photo_path ,
                "created_at" => Carbon::now() , 
                "comment" => Crypt::encryptString($cmt) 
            ];

            array_unshift($recent_comments, (object)$obj);
            Cache::put('recent-comments-' . $this->postId , $recent_comments, 60);
        }

        catch (Exception $e){
            return;
        }
    }

}




