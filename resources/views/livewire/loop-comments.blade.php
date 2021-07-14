

<div>

    @foreach( $comments as $comment )

    <div class="mx-auto mb-1 rounded flex items-center border-b-2 border-light-blue-500 comment-wrapper">

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

    {{ $comments->links() }}

</div>

