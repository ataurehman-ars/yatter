



<script type="module">

    Livewire.on(`getMsgSeen-{{ $receiver_id }}` , () => {

        Array.from(document.querySelectorAll(`#chat-interface-{{ $receiver_id }} .seen-notifier`))
        .forEach(seen_notifier => seen_notifier.textContent = `Seen {{ Carbon\Carbon::now()->toTimeString() }}`)
    })

</script>







