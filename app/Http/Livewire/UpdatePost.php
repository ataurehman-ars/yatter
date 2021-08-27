<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Posts;
use App\Models\Comments;

class UpdatePost extends Component
{
    public $post_id;
    public $post_content;
    public $updation;
    public $edit;
    public $reload;

    public function mount($post_id, $post_content)
    {
        $this->post_id = $post_id;
        $this->post_content = $post_content;
        $this->updation = $this->post_content;
        $this->edit = false;
        $this->reload = false;
    }

    public function render()
    {
        return view('livewire.update-post');
    }

    public function editMode()
    {
        $this->edit = true;
    }

    public function cancelEdit()
    {
        $this->edit = false;
        $this->updation = $this->post_content;
    }

    public function updatedUpdation()
    {
        $updation = $this->updation;
    }

    public function savePost()
    {
        if(trim($this->updation) !== $this->post_content){

            $is_updated = Posts::where('post_id' , $this->post_id)
            ->update(['post' => $this->updation]);

            if ($is_updated){
                $this->emit('postEdited');
            }
        }
    }

    public function deletePost()
    {
        $is_deleted = Posts::where('post_id' , $this->post_id)
        ->delete();

        $delete_comments = Comments::where('post_id' , $this->post_id)
        ->delete();

        if ($is_deleted){
            $this->emit('postDeleted');
        }
    }
}


