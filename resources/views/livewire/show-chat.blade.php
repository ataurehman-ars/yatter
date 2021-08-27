

<div class="container mx-auto my-4 h-64 overflow-y-scroll grid justify-items-stretch bg-black rounded" id="chat-interface-{{ $other_id }}">
    @foreach (array_reverse(json_decode(json_encode($messages))) as $message)

            @php
                $encrypted_msg = Crypt::decryptString($message->message);
            @endphp

        @if ($message->sent_from == Auth::id())
            <div class="m-2 justify-self-end border-r-4 border-purple-600  px-3 py-1 sender-{{ Auth::id() }}">
                <p class="text-white text-xl"> {{ $encrypted_msg }}</p>
                <p class="text-blue-300"><small> {{ Carbon\Carbon::parse($message->created_at)->format("F j, Y, g:i a") }}</small></p>
            </div>
        @else
            <div class="m-2 justify-self-start border-l-4 border-green-300 px-3 py-1 sender-{{ $other_id }}">
                <p class="text-white text-xl">{{ $encrypted_msg }}</p>
                <p class="text-blue-300"><small> {{ Carbon\Carbon::parse($message->created_at)->format("F j, Y, g:i a") }}</small></p>
            </div>
        @endif        

    @endforeach

    <div class="justify-self-start rounded bg-white text-white text-green-500 px-3 py-1" id="typing">
        <img
        class="h-10 w-10 rounded-full object-cover"
        src = "{{ asset('typing/typing-one.gif') }}" />
    </div>

</div>

<script type="text/javascript">

    var chat_interface = document.getElementById(`chat-interface-{{ $other_id }}`) 

    const scroll_down = () => { 
        
        chat_interface.scroll({ 
            top : chat_interface.scrollHeight , 
            behavior: 'smooth'
        })
    }
    
    scroll_down()

    var typing = document.getElementById('typing')

    function observeLastMsg(){

        typing.style.display = "none"

        let options = {
            root: chat_interface , 
            rootMargin: '0px',
            threshold: 0.5
        }

        let observer = new IntersectionObserver(entries => {

            entries.forEach(entry => {
                if (entry.isIntersecting && entry.target.classList.contains(`sender-{{ $other_id }}`)){

                    Echo.private(`seen-{{ $auth_id }}.{{ $other_id }}`).whisper('msg-seen')
                    observer.disconnect()
                }
            })

        }, options);

        var chats = document.querySelectorAll(`#chat-interface-{{ $other_id }} .sender-{{ $other_id }}`)

        if (chats.length){
            observer.observe(chats[ chats.length - 1 ]);
        }

    }

    observeLastMsg()

</script>


<script type="module">

    Livewire.on('lastMsg' , () => {
        observeLastMsg()
    })

    Echo.private(`typing-{{ $auth_id }}.{{ $other_id }}`)
        .listenForWhisper('typing', (e) => {
            
            typing.style.display = "block"
            scroll_down()

            setTimeout(() => {
                typing.style.display = "none"
                scroll_down()
            }, 2000)
    });


</script>






