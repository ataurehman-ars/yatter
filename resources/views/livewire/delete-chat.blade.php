
<div >
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">    
    <div>
        <button wire:click="deleteChat" 
        class="bg-red-500 text-white font-bold py-2 px-4 rounded shadow-lg">
        <i class="fas fa-trash"></i>
            {{ __('Delete Chat') }}
        </button>
    </div>

    <script type="module">
        window.livewire.on("chat-deleted-{{ $receiver_id }}" , () => {
            document.getElementById("chat-id-{{ $receiver_id }}").style.display = "none"
        })
    </script>
</div>


