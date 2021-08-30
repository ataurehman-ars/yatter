
<div>

    @php 

        $obj = json_encode(Cache::get("all-likes-" . Auth::id()));
        $cache_exists = Cache::has('all-likes-' . Auth::id());

    @endphp 

    <script>

        var likes = "{{ $cache_exists }}" , 
        echo_obj = '<?php echo $obj; ?>'

        console.log(echo_obj)

        if (likes && !localStorage.getItem("liked-posts")){
            let arr = JSON.parse(echo_obj).map(obj => `${obj.post_id}`)
            localStorage.setItem("liked-posts" , JSON.stringify(arr))
            console.log(arr)
        }

    </script>
</div>


