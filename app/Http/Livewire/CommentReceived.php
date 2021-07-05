<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Crypt;
use Auth;

use Illuminate\Contracts\Encryption\DecryptException as DE;

class CommentReceived extends Component
{
    public $postId;
    public $new_comment;
    public $username;
    public $img_url;

    public function mount($postId)
    {
        $this->postId = $postId;
        $this->new_comment = '';
        $this->username = '';
        $this->img_url = '';
    }

    public function getListeners()
    {
        return [
            "commentAdded-{$this->postId}" => 'commentAdded', 
        ];
    }

    public function render()
    {
        return view('livewire.comment-received');
    }

    public function commentAdded($comment , $uname, $url)
    {   
        try {
            $this->new_comment = Crypt::decryptString($comment);
        }
        catch(DE $e){
            $this->new_comment = $comment;
        }
        
        $this->username = $uname;
        $this->img_url = $url ? "uploads/$url" : "uploads/profile-photos/user.png";

        $this->emit('call-update-function-' . Auth::id(), $this->new_comment, $this->username, $this->img_url);
    }

}



