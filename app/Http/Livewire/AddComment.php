<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Comments;
use App\Events\NewComment;

use Illuminate\Database\QueryException as QE;

use Illuminate\Http\Support\Facades\Event;

use Crypt;
use Auth;

use Illuminate\Encryption\Encrypter;


class AddComment extends Component
{
    
    public $authId;
    public $postId;
    public $comment;

    public function mount($authId, $postId)
    {
        $this->authId = $authId;
        $this->postId = $postId;
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
                    $this->emit('update-comment-section-' . $this->postId, $this->comment);
                    $this->comment = '';
                }

            }

            catch (QE $e){
                dd("Couldn't add comment");
            }

        }
    }

}




