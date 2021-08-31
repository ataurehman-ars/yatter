

<div class="override-container">

@if (count($shared_posts))

    <div class="m-2">

        @foreach($shared_posts as $post)

            @php 
                $skip_text = strlen($post->post) >= 30 ? substr($post->post ,0, 30) . "..." : $post->post;
            @endphp 

            <div class="m-2 my-4">
                <a
                href="{{ route('view-post' , ['post_id' => $post->post_id]) }}" class=""> 
                    <small class="font-bold">{{ $post->sharer_username . __(' shared post of ') . $post->author_username }}</small>
                    <small class="text-xs">{{ Carbon\Carbon::parse($post->created_at)->format("F j, Y, g:i a")  }}</small>    
                </a>
                <p class="flex break-all font-bold text-xl">{{ $skip_text }}</p>
            </div>

        @endforeach

    </div>

@else 
    <div class="flex items-center justify-center mt-16">
        <p>{{ __('No Shared Posts') }}</p>
    </div>     

@endif 


</div>


