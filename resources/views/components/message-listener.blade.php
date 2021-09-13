
<div>
    @php 
        $conns = Cache::get("connections-" . Auth::id() );
    @endphp 

    <script type="module">

        var conns = []

        conns =  {!! $conns !!}

        conns = conns.length ? conns : JSON.parse(localStorage.getItem("conns"))

        conns.forEach(conn => {
            Echo.private(`newmessageto.{{ Auth::id() }}.${conn.connection_id}`)
            .listen("NewMessage" , () => {
                Array.from(document.getElementsByClassName('inbox-after'))
                .forEach(inbox => inbox.style.display = "inline-block")
            })
        })

    </script>
</div>


