
@if(count($comments))

<div id="rendered-comments">

    @foreach( $comments as $comment )

    <div class="mx-auto mb-1 flex items-center comment-wrapper mb-4">

        @php 

            $image_url = $comment->profile_photo_path ? 
            'uploads/' . $comment->profile_photo_path :
            'uploads/profile-photos/user.png';

        @endphp 

        <div class="grid">
            <div class="flex items-center">
                <div>
                    <img class="h-8 w-8 rounded-full mr-2 object-cover" src="{{ asset($image_url) }}" />
                </div>
                <div class="grid">
                    <div>
                        <p class="text-lg"><strong>{{ $comment->username }}</strong></p>
                    </div>
                    <div>
                        <p class="text-xs"><span>{{ \Carbon\Carbon::parse($comment->created_at)->format("F j, Y, g:i a") }}</span></p>
                    </div>
                </div>
            </div>
            <div class="grid">
                <p class="text-lg my-1 break-normal overflow-ellipsis">{{ Crypt::decryptString($comment->comment) }}</p>
            </div>
        </div>
    </div>

    @endforeach

    @php 
        try {
            $links = gettype($comments) != "array" ? $comments->links() : '';
        }
        catch (Exception $e){
            $links = '';
        }
    @endphp 

    {{ $links ?: $links }}

</div>

@else

    <div class="flex items-center justify-center mt-16">
        <p>{{ __('No Comments') }}</p>
    </div> 

@endif 

