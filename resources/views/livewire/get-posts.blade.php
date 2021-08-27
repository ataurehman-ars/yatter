<div>
        

    @if (count($posts))

        <div class="m-2 md:w-auto">

            @foreach($posts as $post)

                <div class="flex m-2 md:w-auto border-b border-gray-300 post-links">
                    <x-jet-dropdown-link 
                    href="{{ route('view-post' , ['post_id' => $post->post_id]) }}" class="grid"> 
                            <p class="font-semibold post-text">{{ $auth_name }}</p>
                            <small class="post-text">{{ Carbon\Carbon::parse($post->created_at)->format("F j, Y, g:i a")  }}</small>    
                            <p class="font-semibold text-2xl post-text">{{ $post->post }}</p>
                    </x-jet-dropdown-link>
                </div>

            @endforeach

        </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Posts') }}</p>
        </div>     

    @endif 

</div>


