

<div class='inbox-container'>

    <style>

        .chat {
            opacity : 0;
            transform : translateY(20px);
            animation : chat-appear 1s forwards ease-in-out;
        }


        @keyframes chat-appear{

            50% {
                opacity : 50%;
            }
            100% {
                transform : translateY(0);
                opacity : 100%;
            }
        }

    </style>

    <script type="text/javascript">
        var decrypted_msgs = {}
    </script>

    @if (count($collector))

    <div id="inbox" class="w-screen">

        @foreach($collector as $collect)

            @livewire('chat-person' , ['collect' => $collect])

        @endforeach 

    </div>

    @else 
        <div class="flex items-center justify-center mt-16">
            <p>{{ __('No Chats') }}</p>
        </div>  

    @endif 

    <script type="module">

        var inbox = document.getElementById("inbox") , 
        conns = []
    
        conns = {!! Cache::get('connections-' . Auth::id()) !!}

        conns = typeof conns !== "undefined" || typeof conns !== "null" ? conns : JSON.parse(localStorage.getItem("conns"))

        conns.forEach(conn => {

            Echo.private(`newmessageto.{{ Auth::id() }}.${conn.connection_id}`)
            .listen("NewMessage" , (e) => {

                if (inbox.contains(document.getElementById(`inbox-${e.sender_id}`))){

                    let removed = inbox
                    .removeChild(document.getElementById(`inbox-${e.sender_id}`))

                    if(inbox.children.length){
                        inbox.insertBefore(removed, inbox.children[0])
                    }
                    else {
                        inbox.appendChild(removed)
                    }

                    removed.style.display = "block"
                    removed.className = "chat"

                    return 
                }

                Livewire.emit("refresh-inbox")

            })

            Echo.private(`newmessageto.${conn.connection_id}.{{ Auth::id() }}`)
            .listen("NewMessage" , (e) => {

                if (inbox.contains(document.getElementById(`inbox-${e.receiver_id}`))){

                    let removed = inbox
                    .removeChild(document.getElementById(`inbox-${e.receiver_id}`))


                    if(inbox.children.length){
                        inbox.insertBefore(removed, inbox.children[0])
                    }
                    else {
                        inbox.appendChild(removed)
                    }

                    removed.style.display = "block"
                    removed.className = "chat"

                    return 
                }

                Livewire.emit("refresh-inbox")

            })
        })

    </script>
   
    
</div>






