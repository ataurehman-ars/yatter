

@if (!$edit)
    <div class="flex my-2">
        <div>
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
            wire:click="editMode">
                {{ __('Edit') }}
            </button>
        </div>
        <div>
            <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mx-2"
            wire:click="deletePost">
                {{ __('Delete') }}
            </button>
        </div>   
    </div>  

@else 

    <div>

        <div class="container mx-auto my-4 ">
            <textarea class="resize-none border-gray-400 container lg h-64" 
                value="{{ $post_content }}"
                name="updation"
                wire:model.defer="updation">
            </textarea>
        </div>

        <div class="flex mx-4 my-2">
            <div>
                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                wire:click="savePost">
                    {{ __('Update') }}
                </button>
            </div>

            <div class="mx-2">
                <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                wire:click="cancelEdit">
                    {{ __('Cancel') }}
                </button>
            </div>
        </div>

    </div>


@endif


