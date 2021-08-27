<div class="mt-2">    
    <style>

        .update {
            color : #fff;
        }

    </style>

@if (!$edit)
    <div class="flex my-2">
        <div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg mr-2"
            wire:click="editMode">
            <i class="far fa-edit update"></i>
                {{ __('Edit') }}
            </button>
        </div>
        <div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg"
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

        <div class="flex my-2">
            <div>
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg mr-2"
                wire:click="savePost">
                <i class="fas fa-check update"></i>
                    {{ __('Update') }}
                </button>
            </div>

            <div class="mx-2">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg"
                wire:click="cancelEdit">
                <i class="fas fa-times update"></i>
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>

    </div>


@endif


</div>

