
<x-app-layout>
    <div class="m-4 grid">
        <div class="flex">
            

            @foreach($post_contents as $content)

            @php 
                $photo_url = $content->profile_photo_path
                ? 'uploads/' . $content->profile_photo_path
                : 'uploads/profile-photos/user.png';
            @endphp

            <div>
                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_url) }}"/>
            </div>

            <div class="mx-2">
                <h2><p class="font-thin text-sm">{{ $content->name }}</p></h2>
                <p class="font-thin text-xs">{{ $content->created_at }}</p>
            </div>
        </div>    

        <div>
            <p class="my-2 semi-bold text-2xl non-italic">{{ $content->post }}</p>
        </div>   

        @if ($content->related_photo)
            <div>
                <img class="h-10 w-10 rounded-full object-cover" src="{{ 'post-images/' . $content->related_photo }}"/>
            </div>
        @endif 

        @if(Auth::id() == $content->id)
            @livewire('update-post' , ['post_id' => $post_id , 'post_content' => $content->post])
        @endauth 

        @livewire('add-comment' , ['authId' => Auth::id() , 'postId' => $post_id])  

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


