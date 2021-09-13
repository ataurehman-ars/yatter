
<div>

    @php 

        $likes = Cache::get("likes-" . $auth_id );
        $conns = Cache::get("connections-" . $auth_id );

    @endphp 

    <script>

        var likes = []  , conns = []

        if (!localStorage.getItem("liked-posts")){
            likes = {!! $likes !!}
            likes = likes.length ? likes : []
            localStorage.setItem("liked-posts" , JSON.stringify(likes))
        }

        if (!localStorage.getItem("conns")){
            conns = {!! $conns !!}
            conns = conns.length ? conns : []
            localStorage.setItem("conns" , JSON.stringify(conns))
        }

    
        console.log(likes)
        console.log(conns)


    </script>
    
</div>


