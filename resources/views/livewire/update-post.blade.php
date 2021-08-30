
<div class="">    
    

@if (!$edit)
    <div class="flex justify-end my-2">
        <div class="edit-post">
            <button class="bg-transparent font-bold mr-4"
            wire:click="editMode">
            <i class="far fa-edit update"></i>
                {{ __('Edit') }}
            </button>
        </div>
        <div class="delete-post">
            <button class="bg-transparent font-bold"
            wire:click="deletePost">
            <i class="fas fa-trash update"></i>
                {{ __('Delete') }}
            </button>
        </div>   
    </div>  

@else 

    <div>

        <div class="container my-2 ">
            <textarea class="resize-none border-gray-400 container lg h-32 rounded" 
                value="{{ $post_content }}"
                name="updation"
                wire:model.defer="updation">
            </textarea>
        </div>

        <div class="flex justify-end my-2">
            <div class="update-post">
                <button class="bg-transparent font-bold mr-4"
                wire:click="savePost">
                <i class="fas fa-check update"></i>
                    {{ __('Update') }}
                </button>
            </div>

            <div class="cancel-edit">
                <button class="bg-transparent font-bold"
                wire:click="cancelEdit">
                <i class="fas fa-times update"></i>
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>

    </div>


@endif


</div>

