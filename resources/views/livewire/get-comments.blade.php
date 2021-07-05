
@php

    date_default_timezone_set('Asia/Karachi');

@endphp 

<div class='my-4' id="comment-section-{{ $postId }}">

    @if (count($comments))

        @foreach($comments as $comment)

            <div class="mx-auto mb-1 rounded flex items-center border-b-2 border-light-blue-500">

                @php 
                    $image_url = $comment->profile_photo_path ? 
                    'uploads/' . $comment->profile_photo_path :
                    'uploads/profile-photos/user.png';
                @endphp 

                <div>
                    <img class="h-8 w-8 rounded-full mr-2 object-cover" src="{{ asset($image_url) }}" />
                </div>

                <div class="grid">
                    <p class="text-lg">
                        <strong>{{ $comment->username }}</strong>
                    </p>
                    <p class="text-xs">
                        <span>{{ \Carbon\Carbon::parse($comment->created_at)->format("F j, Y, g:i a") }}</span>
                    </p>
                    <p class="text-lg my-1">{{ Crypt::decryptString($comment->comment) }}</p>
                </div>
            </div>

        @endforeach


    @endif 


</div>




<script type="text/javascript">

    var comment_section = document.getElementById(`comment-section-{{ $postId }}`)  , 
    comments = comment_section.children , 
    comments_length = comments.length 

    function updateCommentSection(uname, c, img_src)
    {
        img_src = `http://${location.hostname}:${location.port}/${img_src}`

        let wrap_comment = document.createElement('div') , 
        username = document.createElement('p') , 
        date = document.createElement('p') , 
        comment = document.createElement('p')

        wrap_comment.classList = "mx-auto mb-1 rounded flex items-center border-b-2 border-light-blue-500"

        username.classList = "text-lg"

        let bold = document.createElement("strong")
        bold.textContent = uname
        username.appendChild(bold)

        date.classList = "text-xs"
        date.textContent = "{{ Carbon\Carbon::now()->format("F j, Y, g:i a") }}"
        
        comment.textContent = c 

        let wrap_text = document.createElement('div')
        wrap_text.classList = "grid"

        wrap_text.append(username, date, comment)

        let wrap_img = document.createElement('div') , 
        img = document.createElement('img')

        img.classList = "h-8 w-8 rounded-full mr-2 object-cover"
        img.src = img_src 

        wrap_img.appendChild(img)
        wrap_comment.append(wrap_img, wrap_text)


        if (comments_length){
            comment_section.insertBefore(wrap_comment, comments[0])
        }

        else {
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

