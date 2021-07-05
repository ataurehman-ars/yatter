<div>

    @if (count($posts))

    <div class="m-2 md:w-auto">

        @foreach($posts as $post)

            <div class="flex m-2 md:w-auto">
                <x-jet-dropdown-link 
                href="{{ route('view-post' , ['post_id' => $post->post_id]) }}" class="grid"> 
                        <span>You at {{ $post->created_at  }}</span>
                        <p><strong>{{ $post->post }}</strong></p>
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
