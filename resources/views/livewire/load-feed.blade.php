

@if(count($this->getPosts()))

<div class="m-2 md:w-auto my-4">

    @foreach($this->getPosts() as $post)

        @php 
            $photo_url = $post->profile_photo_path
            ? 'uploads/' . $post->profile_photo_path
            : 'uploads/profile-photos/user.png';
        @endphp

        <x-jet-dropdown-link 
            href="{{ route('view-post' , ['post_id' => $post->post_id ]) }}"
            target="__blank" class="grid"> 

        <div class="flex">
            <div>
                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
            </div>

            <div class="mx-2">
                <h2><p class="font-bold text-sm">{{ $post->username }}</p></h2>
                <p class="font-thin text-xs">{{ $post->created_at }}</p>
            </div>
        </div>    

            <div>
                <p class="my-2 semi-bold text-2xl non-italic">{{ $post->post }}</p>
            </div>               
        </x-jet-dropdown-link>

    @endforeach

</div>

@endif



