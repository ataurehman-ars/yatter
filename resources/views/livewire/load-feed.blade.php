
<div>

    @if(count($this->getPosts()))

    <div class="m-2 md:w-auto my-4" id="feed-container">

        @foreach($this->getPosts() as $post)

            @php 
                $photo_url = $post->profile_photo_path
                ? 'uploads/' . $post->profile_photo_path
                : 'uploads/profile-photos/user.png';
            @endphp

            <div class="px-4 py-2 rounded my-4">
                <x-jet-dropdown-link 
                    href="{{ route('view-post' , ['post_id' => $post->post_id ]) }}"
                    target="__blank" class="grid rounded"> 

                <div class="flex">
                    <div>
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
                    </div>

                    <div class="mx-2">
                        <h2><p class="font-bold text-xl text-gray-800 font-semibold">{{ $post->username }}</p></h2>
                        <small class="text-gray-800 font-semibold">{{ Carbon\Carbon::parse($post->created_at)->format("F j, Y, g:i a") }}</small>
                    </div>
                </div>    

                    <div>
                        <p class="my-2 font-bold text-4xl text-gray-800">{{ $post->post }}</p>
                    </div>  

                    @if ($post->related_photo)
                        <div>
                            <img class="h-40 w-40 object-contain rounded" src="{{ 'uploads/post-images/' . $post->related_photo }}"/>
                        </div>
                    @endif 
            
                </x-jet-dropdown-link>
            </div>

        @endforeach

    </div>

    @endif

</div>



