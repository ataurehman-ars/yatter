<div>

    <form class="col-span-6 sm:col-span-4 m-6 my-2">
        @csrf 
        <x-jet-input id="search" name="search" type="text" class="mt-1 block w-full" 
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

                <div class="flex m-2 md:w-auto">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{  $photo_url }}"/>
                    <x-jet-dropdown-link 
                    href="{{ route('profile' , ['id' => $info->id ]) }}"
                    target="__blank" class="grid"> 
                        <strong>{{ $info->name }}</strong> 
                        <span>{{ $info->username }}</span>
                    </x-jet-dropdown-link>
                </div>

            @endforeach

        </div>

    @endif

</div>



 