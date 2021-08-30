


<x-main-header />

    @php 
        $photo_url = $author_photo_path 
        ? 'uploads/' . $author_photo_path
        : 'uploads/profile-photos/user.png';
    @endphp

    <x-app-layout>
        <div class="flex items-center space-x-1.5 items-center my-4 justify-center">
            <div class="">
                <img class="h-10 w-10 rounded-full object-cover" src="{{ $photo_url }}"/>
            </div>  
            <div class="mb-4">
                <h2 class="">
                    <p class="text-2xl text-gray-700 font-semibold mx-auto">{{ __('Posts by ') . $author_name }}</p>
                </h2>
            </div>   
        </div>   
        @livewire('get-posts' , [ 'auth_id' => $author_id , 'auth_name' => $author_name ])
    </x-app-layout>

<x-main-footer />




