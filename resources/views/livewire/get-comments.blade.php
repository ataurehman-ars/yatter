
<div>

    @php

        date_default_timezone_set('Asia/Karachi');

    @endphp 



    <div class='my-4' id="comment-section-{{ $postId }}"></div>


<script type="text/javascript">

    var comment_section = document.getElementById(`comment-section-{{ $postId }}`) 
    

    function updateCommentSection(uname, c, img_src)
    {
        let comments = document.querySelectorAll(`#comment-section-{{ $postId }} .comment-wrapper`)

        img_src = `http://${location.hostname}:${location.port}/${img_src}`

        let wrap_comment = document.createElement('div') , 
        username = document.createElement('p') , 
        date = document.createElement('p') , 
        comment = document.createElement('p')

        wrap_comment.classList = "mx-auto mb-1 rounded flex items-center border-b-2 border-light-blue-500 comment-wrapper"

        wrap_comment.innerHTML = 
        `<div class="grid">
            <div class="flex">
                <div>
                    <img class="h-8 w-8 rounded-full mr-2 object-cover" src=${img_src} />
                </div>
                <div class="grid">
                    <div>
                        <p class="text-lg"><strong>${uname}</strong></p>
                    </div>
                    <div>
                        <p class="text-xs"><span>{{ Carbon\Carbon::now()->format("F j, Y, g:i a") }}</span></p>
                    </div>
                </div>
            </div>
            <div class="grid">
                <p class="text-lg my-1 break-normal overflow-ellipsis">${c}</p>
            </div>
        </div>`

        try {
            comment_section.insertBefore(wrap_comment, comments[0])        
        }
        catch {
            comment_section.appendChild(wrap_comment)
        }

    }


</script>



<script type="module">


    Livewire.on(`update-comment-section-{{ $postId }}` , c => {

        Livewire.emit('commentAdded-{{ $postId }}' , c , 
        "{{ Auth::user()->username }}" , "{{ Auth::user()->profile_photo_path }}")
    })

    Echo.channel('private-newcomment.{{ $postId }}')
    .listen('NewComment' , (e) => {

        Livewire.emit('commentAdded-{{ $postId }}' , e.comment, e.username, e.photo_url)
    })

</script>



    @livewire('comment-received' , [ 'postId' => $postId ])

    @livewire('select-comments' , ['postId' => $postId, 'page_number' => request()->get('page') ?: 1 ] )


    @if ($filter == "recent")

        <div wire:loading class="mx-auto my-4">
            loading all comments...
        </div>

        {{ App\Http\Controllers\RecentComments::getRecentComments($postId) }}

    @elseif ($filter == "all")

        <div wire:loading class="mx-auto my-4">
            loading recent comments...
        </div>

        {{ App\Http\Controllers\GetComments::getCommentsView($postId, $page_number) }}

    @endif 

</div>



