

<div class="flex flex-row-reverse flex-grow-0 sm:flex-grow content-center">

    @if( !$ack )

        <div>
            <button wire:click="deleteRequest({{true}})" class="bg-red-500 hover:bg-black-700 text-white font-bold py-2 px-4 rounded-full m-2">
                {{ __('Delete') }}
            </button>
        </div>
        <div>
            <button wire:click="makeConnection()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full m-2">
                {{ __('Accept') }}
            </button>
        </div>

    @else
        <div>
            <p class="text-green"> {{ $this->updateText() }} </p>
        </div>    
    @endif

    @if ($reload_page)
        <script>
            location.reload()
        </script>
    @endif

</div>



