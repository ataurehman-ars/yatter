
<div>

    <style>
        .likes::before , .comments::before, .shares::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
        }

        .likes::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f004";
            color : red;
        }

        .comments::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f086";
            color : lightgreen;
        }

        .shares::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f064";
            color : #33D1FF;
        }

    </style>

    @if(count($posts))

    <div class="my-4 override-container" id="feed-container">

        <div class="new-content">

            @foreach($posts as $post)

                @php 
                    $photo_url = $post->profile_photo_path
                    ? 'uploads/' . $post->profile_photo_path
                    : 'uploads/profile-photos/user.png';

                    $skip_text = strlen($post->post) >= 30 ? substr($post->post, 0, 30) . "..." : $post->post;

                @endphp

                <div class="p-4 my-8 grid">

                    <div class="flex items-center">
                        <div>
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
                        </div>

                        <div class="mx-2">
                            <h2><p class="font-bold font-semibold">{{ $post->username }}</p></h2>
                            <small class="">{{ Carbon\Carbon::parse($post->created_at)->format("F j, Y, g:i a") }}</small>
                        </div>
                    </div>    

                    <a href="{{ route('view-post' , ['post_id' => $post->post_id ]) }}" target="__blank" class="grid rounded"> 
                        <div class="">
                            <p class="my-2 font-bold break-all main-text">{{ $skip_text }}</p>
                        </div>
                    </a>  

                    @if ($post->related_photo)
                        <div>
                            <img class="h-40 w-40 object-contain rounded" src="{{ 'uploads/post-images/' . $post->related_photo }}"/>
                        </div>
                    @endif 

                    <div class="likes-comments flex items-center mt-2">
                        <div class="likes mr-4">
                            <strong>{{ $counts['post-' . $post->post_id]->likes . __(' Likes') }}</strong>
                        </div>
                        <div class="comments mr-4">
                            <strong>{{ $counts['post-' . $post->post_id]->comments . __(' Comments') }}</strong>
                        </div>
                        <div class="shares">
                            <strong>{{ $counts['post-' . $post->post_id]->shares . __(' Shares') }}</strong>
                        </div>
                    </div>
            
                </div>


            @endforeach

        </div>

    </div>

    <div wire:loading class="flex mx-2 items-center">
        <p class="text-blue-400 font-semibold">loading content...</p>
    </div>

    @endif


    <div class="flex justify-center">
        <button wire:click="more_feed" class="bg-transparent my-8 font-semibold">load older content</button>
    </div>

    <script type="module">
        Livewire.on('scroll-top' , () => {
            document.body.scrollTop = 0;
        })
    </script>


    <template id="end-observer">

        var feed_container = document.getElementsByClassName("new-content")[0], 
        end_observer = document.getElementsByClassName("end-observer")[0]

        let options = {
            root: feed_container ,  
            rootMargin: '0px',
            threshold: 0.5
        }

        let observer = new IntersectionObserver(entries => {

            entries.forEach(entry => {
                if (entry.isIntersecting){

                    console.log("yes")
                    Livewire.emit('load-old-content')
                    observer.disconnect()
                }
            })

        }, options);

        observer.observe(end_observer)

    </template>

</div>



