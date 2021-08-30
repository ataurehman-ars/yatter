
<div class="">

    <div id="chat-container-{{ $collect['id'] }}" class="flex items-center justify-around">
        

            <div id="chat-id-{{ $collect['id'] }}" class="chats flex items-center mt-4 px-4 py-2">

                @php 
                    $decrypt_msg = Crypt::decryptString($collect['msg']);

                    $photo_path = $collect['profile_photo_path'] 
                    ? 'uploads/' . $collect['profile_photo_path'] 
                    : 'uploads/profile-photos/user.png';

                @endphp 

                <div>
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_path) }}" >
                </div>

                <div>
                    <a href="{{ route('messages' , [ 'receiver_id' => $collect['id'] ]) }}"
                        target="__blank" class="flex items-center"> 
                        <div class="grid mx-2">
                            <p class="font-bold text-xl">{{ $collect['username'] }}</p>
                            <p class="flex break-all">
                                <small class="sent-from font-semibold text-xl">{{ "Me: " }}</small>
                                <span class="decrypted-msg font-semibold text-xl"> {{ $decrypt_msg }}</span>
                            </p>
                        </div>
                    </a>
                </div>

            </div>


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

        <div class="">
            @livewire('delete-chat' , ['receiver_id' => $collect['id'] ] )
        </div>

    </div>

</div>


