

<div class="flex flex-row-reverse flex-grow-0 sm:flex-grow content-center">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">    

    @if( !$ack )

        <div>
            <button wire:click="deleteRequest({{true}})" 
            class="bg-red-500 text-white font-bold py-2 px-4 rounded shadow-lg mt-2 ml-2">
                <i class="fas fa-trash"></i>
                {{ __('Delete') }}
            </button>
        </div>
        <div>
            <button wire:click="makeConnection()" 
            class="bg-blue-500 text-white font-bold py-2 px-4 rounded shadow-lg mt-2">
            <i class="fas fa-user-plus"></i>
                {{ __('Accept') }}
            </button>
        </div>

    @else
        <div>
            <p class="text-gray-800 text-sm"> {{ $this->updateText() }} </p>
        </div>    
    @endif

    @if ($reload_page)
        <script>
            location.reload()
        </script>
    @endif

</div>



