
<div>
    @if(count($listConnections))

        <div class="m-2">

            @foreach($listConnections as $info)

                <div class="mt-4 grid sm:flex sm:flex-grow-0 flex-grow content-center">
                    <div class="flex">

                        @php 
                            $photo_url = $info->profile_photo_path
                            ? 'uploads/' . $info->profile_photo_path
                            : 'uploads/profile-photos/user.png';
                        @endphp

                        
                        <x-jet-dropdown-link 
                            href="{{ route('messages' , [ 'receiver_id' => $info->id ]) }}"
                            target="__blank" class="flex"> 

                            <div>
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
                            </div>

                            <div class="grid mx-4" >
                                <strong id="{{ __('connection-name-') . $info->id }}">{{ $info->name }}</strong> 
                                <span>{{ $info->username }}</span>
                                @livewire('user-active-status' , ['userId' => $info->id ])
                            </div>

                        </x-jet-dropdown-link>    

                    </div> 

                    @livewire('delete-connection', ['userId' => $info->id, 'authId' => Auth::id() ])

                </div>

            @endforeach

        </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Connections') }}</p>
        </div>    

    @endif
</div>


