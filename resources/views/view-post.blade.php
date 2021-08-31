
    @if(!count($post_contents))

        <p>Post deleted by author</p>

    @else 

    <x-main-header />

            <link rel="stylesheet" type="text/css" href="{{ mix('css/style.css') }}">  

        <x-app-layout>
            <div class="my-4 grid p-4 override-container">
                <div class="flex">
                    

                    @foreach($post_contents as $content)

                    @php 
                        $photo_url = $content->profile_photo_path
                        ? 'uploads/' . $content->profile_photo_path
                        : 'uploads/profile-photos/user.png';
                    @endphp

                    <div class="flex items-center">
                        <div>
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
                        </div>

                        <div class="mx-2">
                            <h2><p class="text-xl font-bold text-gray-700">{{ $content->username }}</p></h2>
                            <small>{{ Carbon\Carbon::parse($content->created_at)->format("F j, Y, g:i a") }}</small>
                        </div>
                    </div>
                </div>    

                <div>
                    <p class="my-2 semi-bold text-4xl non-italic flex break-all">{{ $content->post }}</p>
                </div>   

                @if ($content->related_photo)
                    <div>
                        <img class="h-40 w-40 object-contain rounded" src="{{ 'uploads/post-images/' . $content->related_photo }}"/>
                    </div>
                @endif 

                <div class="grid">

                    <div class="flex items-center">
                        @livewire('like-post' , ['post_id' => $post_id , 'author_id' => $content->id ])

                        @if(Auth::id() != $content->id)
                            @livewire('share-post' , ['post_id' => $post_id, 'post_contents' => $content])
                        @endauth 
                    </div>

                    @if(Auth::id() == $content->id)
                        @livewire('update-post' , ['post_id' => $post_id , 'post_content' => $content->post])
                    @endauth 

                </div>

                @livewire('add-comment' , ['postId' => $post_id , 'author_id' => $content->id])  

                    @endforeach

                    @livewire('get-comments' , ['postId' => $post_id, 'page_number' => request()->get('page') ?: 1 ])


            </div>

        </x-app-layout>

        <script>

            Livewire.on('postEdited', function() {
                location.reload()
            })

            Livewire.on('postDeleted', function() {
                location.href = "{{ route('posts') }}"
            })

        </script>

        <script type="text/javascript">

            var scroll_to = "{{ $comment_id }}"
            var target_comment = document.getElementById(`comment-${scroll_to}`)

            if (scroll_to && target_comment){

                target_comment.scrollIntoView({
                    behaviour : "smooth"
                });

                target_comment.style.backgroundColor = "#87CEFA"

                setTimeout(() => target_comment.style.backgroundColor = "transparent" , 2000)
            }

        </script>

        <x-aside />


    <x-main-footer />

        
    @endif 


