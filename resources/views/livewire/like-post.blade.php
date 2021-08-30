
<div>

    <style>

        .like-button::before , .liked::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f004";
            font-size : 25px;
            margin-right : 5px;
        }

        .liked::before {
            color : red;
        }

    </style>

    <div class="my-2 outline-none" id="like-container">
        <button wire:click="like_post()" class="text-xl font-bold flex items-center like-button" id="like-button" >
            Like
        </button>
    </div>

    <script type="text/javascript">

        var like_button = document.getElementById("like-button") , 
        liked_posts = localStorage.getItem("liked-posts") , 
        like_container = document.getElementById("like-container")

        if (liked_posts && JSON.parse(liked_posts).includes("{{ $post_id }}")){
            like_post(true)
        }

        function like_post(liked=false, status='') {

            if (liked){
                like_button.classList += " liked"
                like_button.textContent = "Liked"
                return 
            }

            //const status = like_button.textContent.toLowerCase().trim()

            like_button.textContent = status === "liked" ?  "Liked" : "Like"

            if (liked_posts){

                let to_arr = JSON.parse(localStorage.getItem("liked-posts"))


                if (status === "unliked"){

                    to_arr = to_arr.filter(id => id !== "{{ $post_id }}")
                    localStorage.setItem("liked-posts" , JSON.stringify(to_arr))

                    if (like_container.contains(document.getElementById("liked"))){
                        like_container.removeChild(document.getElementById("liked"))
                    }
                    like_container.appendChild(document.getElementById("display-gray").content.cloneNode(true))
                    
                    return 
                }


                to_arr.push("{{ $post_id }}")
                localStorage.setItem("liked-posts" , JSON.stringify(to_arr))

                if (like_container.contains(document.getElementById("not-liked"))){ 
                    like_container.removeChild(document.getElementById("not-liked"))
                }
                like_container.appendChild(document.getElementById("display-red").content.cloneNode(true))

                return  
            }

            liked_posts = []
            liked_posts.push("{{ $post_id }}")
            localStorage.setItem("liked-posts" , JSON.stringify(liked_posts))
        }

    </script>

    <template id="display-red">
        <style id="liked">
            .like-button::before {
                color : red;
            }
        </style>
    </template>

    <template id="display-gray">
        <style id="not-liked">
            .like-button::before {
                color : #333333;
            }
        </style>
    </template>

    <script type="module">

        Livewire.on("liked-{{ $post_id }}" , msg => {
            console.log(msg)
            like_post(false , msg.trim())
        })

    </script>

</div>



