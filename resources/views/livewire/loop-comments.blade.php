

<div>

    @foreach( $comments as $comment )

    <div class="mx-auto mb-1 rounded grid border-b-2 border-light-blue-500 comment-wrapper">

        @php 

            
            $image_url = $comment->profile_photo_path ? 
            'uploads/' . $comment->profile_photo_path :
            'uploads/profile-photos/user.png';

        @endphp 

        <div class="flex items-center">
            <div>
                <img class="h-8 w-8 rounded-full mr-2 object-cover" src="{{ asset($image_url) }}" />
            </div>

            <div class="grid">
                <p class="text-lg"><strong>{{ $comment->username }}</strong></p>
                <small>{{ \Carbon\Carbon::parse($comment->created_at)->format("F j, Y, g:i a") }}</small>
                <p class="text-lg">{{ Crypt::decryptString($comment->comment) }}</p>
            </div>
        </div>
    </div>

    @endforeach

    {{ $comments->links() }}

</div>

