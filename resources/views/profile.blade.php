
<!-- <div class="content-container">

    <div class="bg-gradient-to-r from-green-400 via-yellow-500 to-blue-500">
        <div class="flex justify-center rounded"> -->
        <x-main-header />

            @if (Auth::check())

                <x-app-layout>

                    <div class="grid justify-items-stretch mt-16">
                        @foreach($user_info as $info)

                        @php 
                            $photo_url = $info->profile_photo_path
                            ? 'uploads/' . $info->profile_photo_path
                            : 'uploads/profile-photos/user.png';

                        @endphp

                            <div class="justify-self-center mb-4">
                                <img class="h-40 w-40 rounded object-cover bg-transparent" src="{{ $photo_url }}"/>
                            </div>

                            <div>
                                <h1 class="align-center">
                                    <p class="text-6xl text-center capitalize font-semibold text-gray-700">{{ $info->name }}</p>
                                </h1>
                            </div>

                            <div class="my-2">
                                <h2 class="align-center">
                                    <p class="text-2xl text-center font-semibold">{{ __('@') . $info->username }}</p>
                                </h2>
                            </div>
                            
                        @endforeach
                    </div>    

                    @if ( Auth::id() != $userId )

                        @livewire('add-user' , ['userId' => $userId ])

                    @endif

                    <div class="grid my-4">
                        <div class="flex space-x-2 justify-self-center">

                            <link rel="stylesheet" href="{{ mix('css/style.css') }}">    

                            <style>
                                .count {
                                    margin-left : 5px;
                                    font-size : 15px;
                                    color : #000;
                                }
                            </style>    

                            @livewire('count-connections')
                            @livewire('count-posts')

                        </div>
                    </div>

                    <div class="grid justify-items-stretch my-4">
                        <div class="justify-self-center">
                            <x-jet-dropdown-link 
                                href="{{ route('all-posts' , [ 'author_id' => $userId ]) }}"
                                target="__blank" class="flex"
                                class="text-2xl text-gray-800 text-semibold"> 
                                    {{ __('View All Posts' )}}
                            </x-jet-dropdown-link>    
                        </div>
                    </div>

                        
                </x-app-layout>
                
            @endif

        <x-main-footer />
            
        <!-- </div>

    </div>
    
    <script type="text/javascript" src="{{ asset('js/override.js') }}"></script>

</div> -->


