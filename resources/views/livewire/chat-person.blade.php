
<div id="inbox-{{ $collect['id'] }}">

    <div id="chat-container-{{ $collect['id'] }}" class="flex items-center justify-around">
        

            <div id="chat-id-{{ $collect['id'] }}" class="chats flex items-center mt-4 px-4 py-2">

                @php 

                    $decrypt = Crypt::decryptString($collect['msg']);
                    $decrypt_msg = strlen($decrypt) >= 20 ? substr($decrypt, 0, 20) . "..." : $decrypt;

                    $photo_path = $collect['profile_photo_path'] 
                    ? 'uploads/' . $collect['profile_photo_path'] 
                    : 'uploads/profile-photos/user.png';

                @endphp 

                <div class="mr-4">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ asset($photo_path) }}" >
                </div>

                <div>
                    <a href="{{ route('messages' , [ 'receiver_id' => $collect['id'] ]) }}"
                        target="__blank" class="flex items-center"> 
                        <div class="grid">
                            <p class="font-bold text-xl chat-username">{{ $collect['username'] }}</p>
                            <div class="flex">
                                <p class="decrypted-msg flex break-all w-64">
                                    <span class="sent-from font-semibold">{{ "Me: " }}</span>
                                    {{ $decrypt_msg }}
                                </p>
                            </div>
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

                    document.querySelector(`#chat-container-${id}`).classList = "flex items-center justify-around"

                    let format_msg = msg.length >= 20 ? 
                    (sent_by_own ? "Me: " : "") + msg.substr(0, 20) + "..." 
                    : (sent_by_own ? "Me: " : "") + msg

                    decrypted_msgs[`msg-${id}`].textContent = format_msg 

                    //decrypted_msgs[`sent-from-${id}`].style.display = 
                    //sent_by_own ? "inline-block" : "none"

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


