

<div class="flex items-center col-span-6 sm:col-span-4 m-6 my-2">

    @if ( !$this->checkIfConnection() )
    
        <button wire:click="addUser()" 
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block w-full">
            {{ $this->ifRequested() }}
        </button> 

    @else
        <p>{{ __('One of your connections' ) }}</p>

    @endif

   

</div>


