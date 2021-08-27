<div>

    <form class="col-span-6 sm:col-span-4 m-6 my-4">
        @csrf 
        <input id="search" name="search" type="text" class="mt-1 block w-full shadow-lg border-transparent rounded" 
        wire:model="search" placeholder="{{ __('Search') }}"  />

        <x-jet-input-error for="search" class="mt-2" />
    </form>

    @if(trim($search) && count($arr))

        <div class="m-2 md:w-auto my-4">

            @foreach($arr as $info)

            @php 
                $photo_url = $info->profile_photo_path
                ? 'uploads/' . $info->profile_photo_path
                : 'uploads/profile-photos/user.png';
            @endphp

                <div class="flex items-center">

                    <div>
                        <img class="h-10 w-10 rounded-full object-cover" src="{{  $photo_url }}"/>
                    </div>

                    <div>
                        <x-jet-dropdown-link 
                        href="{{ route('profile' , ['id' => $info->id ]) }}"
                        target="__blank" class="grid"> 
                            <p class="text-gray-800 text-semibold text-2xl">{{ $info->name }}</p> 
                            <p class="text-black">{{ $info->username }}</p>
                        </x-jet-dropdown-link>
                    </div>
                </div>

            @endforeach

        </div>

    @endif

</div>



 