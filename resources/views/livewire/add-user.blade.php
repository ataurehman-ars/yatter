

<div class="grid justify-items-stretch my-4">

    @if ( !$this->checkIfConnection() )
    
        <div class="justify-self-center">
            <button wire:click="addUser()" 
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block">
                {{ $this->ifRequested() }}
            </button> 
        </div>

    @else
        <div class="justify-self-center">
            <p class="text-center text-gray-600">{{ __( 'One of your connections' ) }}</p>
        </div>

    @endif

   

</div>


