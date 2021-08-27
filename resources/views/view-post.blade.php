
    <x-main-header />

            <link rel="stylesheet" type="text/css" href="{{ mix('css/style.css') }}">  

        <x-app-layout>
            <div class="my-4 grid p-4">
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
                            <h2><p class="text-4xl font-semibold text-gray-700">{{ $content->username }}</p></h2>
                            <small>{{ Carbon\Carbon::parse($content->created_at)->format("F j, Y, g:i a") }}</small>
                        </div>
                    </div>
                </div>    

                <div>
                    <p class="my-2 semi-bold text-4xl non-italic">{{ $content->post }}</p>
                </div>   

                @if ($content->related_photo)
                    <div>
                        <img class="h-40 w-40 object-contain rounded" src="{{ 'uploads/post-images/' . $content->related_photo }}"/>
                    </div>
                @endif 

                @if(Auth::id() == $content->id)
                    @livewire('update-post' , ['post_id' => $post_id , 'post_content' => $content->post])
                @endauth 

                @livewire('add-comment' , ['postId' => $post_id , 'author_id' => $content->id])  

                    @endforeach

                    @livewire('get-comments' , ['postId' => $post_id])


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

        <x-aside />


    <x-main-footer />

        



