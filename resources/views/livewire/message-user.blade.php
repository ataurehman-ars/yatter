
@php 

    date_default_timezone_set('Asia/Karachi');

@endphp

<div class="container mx-auto my-4">
    <textarea wire:model.defer="message" 
        id="msg"
        name="message" 
        placeholder="{{ __('type new message') }}"
        class="resize-none border-gray-400 container lg rounded h-32">
    </textarea>

    <button class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded my-2"
    wire:click="sendMessage" id="msg-btn">
        {{__('Send Message')}}
    </button>
</div>


<script type="text/javascript">

    function updateInterface(message, from_self=true){

        let wrap_msg = document.createElement("div") , 
        p = document.createElement("p") 

        p.textContent = message 

        wrap_msg.appendChild(p)

        wrap_msg.classList = "m-2 justify-self-start rounded bg-green-500 text-white px-3 py-1 sender-{{ $receiver_id }}"

        if (from_self){

            wrap_msg.classList = "m-2 justify-self-end rounded bg-purple-600 text-white px-3 py-1"

            let small = document.createElement("small")
            small.className = "seen-notifier"
            small.textContent = "{{ Cache::has('user-active-' . $receiver_id) ? 'Delivered' : 'Sent' }}"
            small.style.fontSize = "10px"
            wrap_msg.appendChild(small)
            chat_interface.insertBefore(wrap_msg, document.getElementById('typing'))
            scroll_down()

            return 
        }

        chat_interface.insertBefore(wrap_msg, document.getElementById('typing'))
        scroll_down()
        observeLastMsg()
    }

</script>



<script type="module">

    Livewire.on('updateInterface' , message => {
        updateInterface(message)
    })


</script>

<script type="module">

    Echo.channel(`private-newmessageto.{{ $auth_id }}`)
    .listen('NewMessage' , e => {

        Livewire.emit(`decrypt-msg-{{ $receiver_id }}`, e.message)
    })

    Livewire.on('msg-encrypted-{{ $receiver_id }}' , msg => {
        updateInterface(msg, false)
    })

</script>

<script type="module">

    Livewire.on(`user-online-{{ $receiver_id }}`, () => {

        let seen_notifier = document.getElementsByClassName('seen-notifier')

        if (seen_notifier.length){
            seen_notifier[seen_notifier.length - 1].textContent = "Delivered"
        }
    })


</script>


<script type="module">

    document.getElementById('msg').onkeyup = function () {

        let val = this.value , 
        val_len = val.length 

        let isnt_alpha = /[\W\d]/.test(val[val_len - 1]) 

        if (val_len === 1 || isnt_alpha){

            Echo.private(`typing-{{ $receiver_id }}.{{ $auth_id }}`)
                .whisper('typing', {
                    name: `user: {{ $auth_id }} is typing`
            })
        }
    }


</script>



<script type="module">

    Echo.private(`seen-{{ $receiver_id }}.{{ $auth_id }}`)
        .listenForWhisper('msg-seen', (e) => {
            
            let seen_notifier = document.querySelectorAll(`#chat-interface-{{ $receiver_id }} .seen-notifier`)

            if(seen_notifier.length){
                seen_notifier[seen_notifier.length - 1].textContent = `Seen {{ Carbon\Carbon::now()->format("F j, Y, g:i a") }}`
            }
    });

</script>



