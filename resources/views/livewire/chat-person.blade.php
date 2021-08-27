
<div class="">

    <div id="chat-container-{{ $collect['id'] }}">
        <x-jet-dropdown-link 
            href="{{ route('messages' , [ 'receiver_id' => $collect['id'] ]) }}"
            target="__blank" class="flex items-center"> 

            <div id="chat-id-{{ $collect['id'] }}" class="chats flex items-center mt-4 border-2 border-white rounded px-4 py-2">

                @php 
                    $decrypt_msg = Crypt::decryptString($collect['msg']);

                    $photo_path = $collect['profile_photo_path'] 
                    ? 'uploads/' . $collect['profile_photo_path'] 
                    : 'uploads/profile-photos/user.png';

                @endphp 

                <div>
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_path) }}" >
                <div>

                <div class="grid mx-2">
                    <p class="text-xl font-bold black">{{ $collect['username'] }}</p>
                    <p>
                        <small class="sent-from semi-bold text-2xl">{{ "Me: " }}</small>
                        <span class="decrypted-msg text-2xl text-black font-semibold"> {{ $decrypt_msg }}</span>
                    </p>
                </div>

            </div>

        </x-jet-dropdown-link>   

        <script type="module">

            decrypted_msgs["msg-{{ $collect['id'] }}"] = 
            document.querySelector("#chat-id-{{ $collect['id'] }} .decrypted-msg")

            decrypted_msgs["sent-from-{{ $collect['id'] }}" ] = 
            document.querySelector("#chat-id-{{ $collect['id'] }} .sent-from")

            decrypted_msgs["sent-from-{{ $collect['id'] }}" ].style.display = 
            "{{ (bool)$collect['sent_from_own'] }}" ? "inline-block" : "none"  

            function updateInbox(msg, id, sent_by_own=false){

                if (document.querySelector("#inbox")
                .contains(document.querySelector(`#chat-id-${id}`))) { 

                    document.querySelector(`#chat-id-${id}`).style.display = "inline-block"

                    decrypted_msgs[`msg-${id}`].textContent = msg 

                    decrypted_msgs[`sent-from-${id}`].style.display = 
                    sent_by_own ? "inline-block" : "none"

                    return 

                }

            }
            
            
                window.livewire.on("msg-from-{{ $collect['id'] }}", function (msg) {
                    updateInbox(msg, "{{ $collect['id'] }}")
                });

                window.livewire.on("sent-from-own-{{ $collect['id'] }}", function (msg) {
                    updateInbox(msg, "{{ $collect['id'] }}", true)
                });
                


        </script>


        @livewire('update-inbox' , ['receiver_id' => $collect['id'] ] )

        <div class="grid sm:flex sm:flex-grow-0 flex-grow content-center">
            @livewire('delete-chat' , ['receiver_id' => $collect['id'] ] )
        </div>

    </div>

</div>


