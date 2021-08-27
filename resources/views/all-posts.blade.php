

<!-- <div class="content-container">

    <div class="bg-gradient-to-r from-green-400 via-yellow-500 to-blue-500">

        <div class="flex justify-center rounded"> -->
        <x-main-header />
        
            @php 
                $photo_url = $author_photo_path 
                ? 'uploads/' . $author_photo_path
                : 'uploads/profile-photos/user.png';
            @endphp

            <x-app-layout>
                <div class="flex space-x-1.5 items-center m-4">
                    <div>
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $photo_url }}"/>
                    </div>  
                    <div>
                        <h2><p class="text-2xl text-gray-700 font-semibold">{{ __('Posts by ') . $author_name }}</p></h2>
                    </div>   
                </div>   
                @livewire('get-posts' , [ 'auth_id' => $author_id , 'auth_name' => $author_name ])
            </x-app-layout>

        <x-main-footer />

        <!-- </div>

    </div>

    <script type="text/javascript" src="{{ asset('js/override.js') }}"></script>


</div> -->



