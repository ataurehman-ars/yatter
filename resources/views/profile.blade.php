
@if (Auth::check())

    <x-app-layout>

        <div class="grid items-center justify-center mt-16">
            @foreach($user_info as $info)

            @php 
                $photo_url = $info->profile_photo_path
                ? 'uploads/' . $info->profile_photo_path
                : 'uploads/profile-photos/user.png';
            @endphp

                <img class="h-20 w-20 rounded-full object-cover" src="{{ $photo_url }}"/>
                <h1 class="align-center">{{ $info->name }}</h1>
                <h2 class="align-center"> {{ $info->username }}</h2>
                
            @endforeach
        </div>    

        @if ( Auth::id() != $userId )

            @livewire('add-user' , ['userId' => $userId, 'authId' => Auth::id()])

        @endif

            
    </x-app-layout>
    
@endif

