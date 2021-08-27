
<div class="flex flex-row-reverse flex-grow-0 sm:flex-grow content-center">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">    
    <div>
        <button wire:click="deleteConnection()" 
        class="bg-red-500 text-white font-bold py-2 px-4 rounded shadow-lg">
            <i class="fas fa-user-minus"></i>
            {{ __('Delete Connection') }}
        </button>
    </div>

    @if ($reloadPage)
        <script>
            location.reload()
        </script>
    @endif

</div>


