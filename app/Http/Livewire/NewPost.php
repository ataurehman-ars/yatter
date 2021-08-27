<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


use Auth;

class NewPost extends Component
{
    use WithFileUploads;

    public $authId;
    public $post;
    public $can_publish;
    public $postImg;
    public $image_stored;
    public $image_name;

    public function mount()
    {
        $this->authId = Auth::id();
        $this->post = '';
        $this->image_stored = false;
        $this->image_name = '';
        $this->can_publish = false;
    }

    public function render()
    {
        return view('livewire.new-post');
    }

    public function startOver()
    {
        $this->can_publish = false;
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
                //$this->image_stored = $this->postImg->storeAs('post-images', $this->image_name);
                // Storage::disk('public')->put($this->image_name , $this->postImg);
                $this->image_stored = Storage::disk('public')->putFileAs('post-images' , $this->postImg, $this->image_name);
            }

            $this->can_publish = Posts::create([
                'author_id' => $this->authId , 
                'post' => $this->post , 
                'related_photo' => $this->image_stored ? $this->image_name : ''  , 
            ]);

            if ($this->can_publish){
                $this->emit('postAdded'); 
                $this->post = '';   
                $this->postImg = '';
            }

        }

    }
}


