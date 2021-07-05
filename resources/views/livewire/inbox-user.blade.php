

<div>
    @if (count($collector))

        @foreach($collector as $collect)

            <x-jet-dropdown-link 
                href="{{ route('messages' , [ 'receiver_id' => $collect->id ]) }}"
                target="__blank" class="flex"> 

                <div id="chat-id-{{ $collect->id }}" class="">

                    @php 
                        $decrypt_msg = Crypt::decryptString($collect->msg);

                        $photo_path = $collect->profile_photo_path 
                        ? 'uploads/' . $collect->profile_photo_path
                        : 'uploads/profile-photos/user.png';

                    @endphp 

                    <div>
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_path) }}" >
                    <div>

                    <div class="grid mx-2">
                        <p><strong>{{ $collect->username }}</strong></p>
                        <p>
                            <small style="{ fontSize: 10px; }">{{ $collect->sent_from_own ? 'You: ' : ''  }}</small>
                            <span class="decrypted-msg"> {{ $decrypt_msg }}</span>
                        </p>
                    </div>

                </div>

            </x-jet-dropdown-link>   

        @endforeach 


    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Chats') }}</p>
        </div>  

    @endif 

</div>




