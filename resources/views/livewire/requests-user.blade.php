

<div>
    @if(count($listRequests))

        <div class="m-2">

            @foreach($listRequests as $info)

                <div class="mt-4 grid sm:flex sm:flex-grow-0 flex-grow content-center">
                    <div class="flex items-center">

                        @php 
                            $img_url = $info->profile_photo_path ? 
                            'uploads/' . $info->profile_photo_path :
                            'uploads/profile-photos/user.png';
                        @endphp 

                        <div>
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($img_url) }}"/>
                        </div>

                        <div class="grid ml-4">
                            <p class="text-4xl text-gray-800">{{ $info->name }}</p> 
                            <p class="text-gray-800 font-bold">{{ $info->username }}</p>
                        </div>   
                    </div> 

                    @livewire('accept-user', 
                    ['userId' => $info->id , 'req_username' => $info->username , 
                    'req_name' => $info->name , 'req_photo_url' => $info->profile_photo_path ])

                </div>

            @endforeach

        </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Requests') }}</p>
        </div>    

    @endif
</div>


