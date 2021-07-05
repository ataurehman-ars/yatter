<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use Livewire\WithFileUploads;

class NewPost extends Component
{
    use WithFileUploads;

    public $authId;
    public $post;
    public $publish;
    public $postImg;
    public $image_stored;
    public $image_name;

    public function mount($authId)
    {
        $this->authId = $authId;
        $this->post = '';
        $this->image_stored = false;
        $this->image_name = '';
    }

    public function render()
    {
        return view('livewire.new-post');
    }

    public function startOver()
    {
        $this->publish = false;
    }

    public function updatedPost()
    {
        $post = $this->post;
    }

    public function publish()
    {
        if (strlen(trim($this->post)) >= 2){

            if ($this->postImg){

                $this->image_name = md5($this->postImg . microtime()).'.'.$this->postImg->extension();
                $this->image_stored = $this->postImg->storeAs('post-images', $this->image_name);

            }

            $this->publish = Posts::create([
                'author_id' => $this->authId , 
                'post' => $this->post , 
                'related_photo' => $this->image_stored ? $this->image_name : ''  , 
            ]);

            if ($this->publish){
                $this->emit('postAdded'); 
                $this->post = '';   
                $this->postImg = '';
            }

        }

    }
}


