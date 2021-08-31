
<div>

    <style>

        .share-button::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f064";
            margin-right : 5px;
            font-size : 25px;
        }

    </style>

    <div class="flex items-center share-button">
        <button class="text-xl font-bold flex items-center" wire:click="share_post">Share Post</button>
    </div>

    <div>
        <p class="share-msg"></p>
    </div>

    <script type="module">

        Livewire.on('share-event-{{ $post_id }}' , (e) => {

            let msg = document.getElementsByClassName("share-msg")[0]
            msg.textContent = e.trim()

            setTimeout(() => {
                msg.style.display = "none"
            }, 2000)
        })

    </script>
</div>


