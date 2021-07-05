
<div>

    <div class="container mx-auto my-4 ">
        <textarea class="resize-none border-gray-400 container lg h-64" 
            placeholder="{{ __('New Post/Blog') }}"
            name="post"
            wire:model.defer="post"
            wire:click="startOver()">
        </textarea>

        <form class="grid my-2">
        @if ($postImg)
            <img src="{{ $postImg->temporaryUrl() }}">
        @endif
            <span>{{ __('Choose a related photo') }}</span>
            <input type="file" wire:model="postImg">
            @error('photo') <span class="error">{{ $message }}</span> @enderror
        </form>
    </div>


    <div class="container mx-auto my-2 flex content-center">
        <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
        wire:click="publish()">
            {{ __('Post') }}
        </button>
    </div>

</div>

