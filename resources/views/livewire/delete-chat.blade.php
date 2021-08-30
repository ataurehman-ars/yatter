
<div class="" >
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">    
    <div>
        <button wire:click="deleteChat" 
        class="">
        <i class="fas fa-trash"></i>
        </button>
    </div>

    <script type="module">
        window.livewire.on("chat-deleted-{{ $receiver_id }}" , () => {
            document.getElementById("chat-id-{{ $receiver_id }}").style.display = "none"
        })
    </script>
</div>


