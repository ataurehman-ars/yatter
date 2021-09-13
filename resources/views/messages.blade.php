

<x-main-header />

    <x-app-layout>

        <div class="flex items-center container mx-auto my-4">

            @foreach($receiver_details as $detail)

                @php 
                    $photo_url = $detail->profile_photo_path
                    ? 'uploads/' . $detail->profile_photo_path
                    : 'uploads/profile-photos/user.png';
                @endphp

                <div class="ml-4">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
                </div>

                <div class="mx-2 container grid">
                    <p class="mr-2 text-gray-800 text-4xl font-semibold"> {{ $detail->username }}</p>
                    @livewire('user-active-status' , ['userId' => $receiver_id ])
                </div>
                
            @endforeach

        </div>

        @livewire('show-chat' , [ 'auth_id' => Auth::id() , 'other_id' => $receiver_id ] )
        @livewire('message-user' , ['auth_id' => Auth::id() , 'receiver_id' => $receiver_id ])

    </x-app-layout>

<x-main-footer />


<x-message-listener />


