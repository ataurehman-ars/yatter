

<div>
    @if(count($listRequests))

        <div class="m-2">

            @foreach($listRequests as $info)

                <div class="mt-4 grid sm:flex sm:flex-grow-0 flex-grow content-center">
                    <div class="flex">

                        @php 
                            $img_url = $info->profile_photo_path ? 
                            'uploads/' . $info->profile_photo_path :
                            'uploads/profile-photos/user.png';
                        @endphp 

                        <div>
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($img_url) }}"/>
                        </div>

                        <div class="grid ml-4">
                            <strong>{{ $info->name }}</strong> 
                            <span>{{ $info->username }}</span>
                        </div>   
                    </div> 

                    @livewire('accept-user', ['userId' => $info->id, 'authId' => Auth::id() , 'req_username' => $info->username])

                </div>

            @endforeach

        </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Requests') }}</p>
        </div>    

    @endif
</div>


