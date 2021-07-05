
<div>

    <script type="module">

        Livewire.on("call-update-function-{{ Auth::id() }}" , (c, u, p) => { 

            updateCommentSection(u, c,  p)

        })
    </script>  

</div>

