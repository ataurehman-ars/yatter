
<div class="flex flex-row-reverse flex-grow-0 sm:flex-grow content-center">
    <div>
        <button wire:click="deleteConnection()" class="bg-red-500 hover:bg-black-700 text-white font-bold py-2 px-4 rounded-full m-2">
            {{ __('Delete') }}
        </button>
    </div>

    @if ($reloadPage)
        <script>
            location.reload()
        </script>
    @endif

</div>


