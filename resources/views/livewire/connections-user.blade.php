
<div>
    @if(count($listConnections))

        <div class="m-2">

            @foreach($listConnections as $info)

                <div class="mt-4 grid sm:flex sm:flex-grow-0 flex-grow content-center">
                    <div class="flex">

                        @php 
                            $photo_url = $info->connection_photo_url 
                            ? 'uploads/' . $info->connection_photo_url 
                            : 'uploads/profile-photos/user.png';
                        @endphp

                        
                        <x-jet-dropdown-link 
                            href="{{ route('messages' , [ 'receiver_id' => $info->connection_id ]) }}"
                            target="__blank" class="flex items-center"> 

                            <div>
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
                            </div>

                            <div class="grid mx-4" >
                                <p class="text-2xl text-gray-800 font-bold capitalize" id="{{ __('connection-name-') . $info->connection_id }}">
                                    {{ $info->connection_name }}
                                </p> 
                                <p class="text-black">{{ $info->connection_username }}</p>
                                @livewire('user-active-status' , ['userId' => $info->connection_id ])
                            </div>

                        </x-jet-dropdown-link>    

                    </div> 

                    @livewire('delete-connection', ['userId' => $info->connection_id ])

                </div>

            @endforeach

        </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Connections') }}</p>
        </div>    

    @endif
</div>


