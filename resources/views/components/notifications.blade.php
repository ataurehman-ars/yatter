
<div class="ml-4">

    <style>
        .notif-close::before, .notif-pointer::after {
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f00d";
            font-size : 30px;
        }

        .notif-pointer::after {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f111";
            color : cornflowerblue;
            font-size : 8px;
            display : block;
            align-self : center;
            margin-left : 4px;
        }

        .img-size {
            height : 30px;
            width : 30px;
        }

        .notif-container {
            overflow-y : scroll;
            background-color : #fff;
        }

        @media(max-width : 550px){

            .notif-pointer::after {
                display: none;
            }
        }

    </style>

    <div class="flex items-center">
        <div>
            <button class="font-semibold py-2 border-none notif-button" id="notif-button">
                Notifications
            </button>
        </div>
        <div class="flex items-center notif-pointer" id="notif-pointer"></div>
    </div>

    <div class="flex-col h-screen fixed inset-y-0 left-0 shadow-xl border-r border-gray-200 px-4 notif-container">

        <div class="self-end mr-4">
            <button class="notif-close" id="notif-close"></button>
        </div>

        <div class="self-center no-notifs">
            <p>No New Notifications</p>
        </div>

        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

        <div class="w-auto">
            <ul id="notif-list" class="list-none text-sm mx-auto justify-self-center"></ul>
        </div>

        <script type="text/javascript">

            function see_notif(root , observant , pointer){

                let options = {
                    root: root ,  
                    rootMargin: '0px',
                    threshold: 0.5
                }

                let observer = new IntersectionObserver(entries => {

                    entries.forEach(entry => {
                        if (entry.isIntersecting){

                            pointer.style.display = "none"
                            observer.disconnect()
                        }
                    })

                }, options);

                observer.observe(observant)

            }

        </script>

        <script type="text/javascript">

            var notif_list = document.getElementById("notif-list") , 
            saved_list = localStorage.getItem("notif-list") , 
            no_notifs = document.getElementsByClassName("no-notifs")[0] , 
            notif_pointer = document.getElementsByClassName("notif-pointer")[0] 

            notif_pointer.style.display = "none"

            no_notifs.style.display = "none"

            if (saved_list){
                notif_list.innerHTML = saved_list 
            }

            function updateNotif(notif){
                let li = document.createElement("li") , 
                a = document.createElement("a") , 
                img = document.createElement("img") , 
                small = document.createElement("small") , 
                wrap = document.createElement("div")

                let img_path = notif.photo_path ? 'uploads/' + notif.photo_path : 'uploads/profile-photos/user.png'
                img.src = `http://${location.hostname}:${location.port}/${img_path}`
                img.classList = "img-size rounded object-cover block mr-2"

                li.classList = "flex items-center py-4 border-b border-blue-200"

                if (notif.type === "comment"){
                    a.textContent = notif.username + " has something to say about your post"
                    a.href = "view-post?post_id=" + notif.post_id + "&comment_id=" + notif.comment_key 
                }

                if (notif.type === "like"){
                    a.textContent = notif.username + " likes your post"
                    a.href = "view-post?post_id=" + notif.post_id 
                }

                small.textContent = `{{ Carbon\Carbon::now()->format("F j, Y, g:i a") }}`

                a.classList = "block"

                wrap.append(a, small)
                li.append(img , wrap)

                if(notif_list.children.length){
                    notif_list.insertBefore(li, notif_list.children[0])
                    notif_pointer.style.display = "block"
                    see_notif(notif_list , notif_list.children[0] , notif_pointer)
                    localStorage.setItem("notif-list" , notif_list.innerHTML)
                    return 
                }

                notif_list.appendChild(li)
                notif_pointer.style.display = "block"
                see_notif(notif_list , notif_list.children[0] , notif_pointer)
                localStorage.setItem("notif-list" , notif_list.innerHTML)
                no_notifs.style.display = "none"
            }

        </script>

        <script type="module">
            Echo.private(`App.Models.User.{{ Auth::id() }}`)
                .notification(notif => {
                    updateNotif(notif)
            });
        </script>

    </div>

    <script type="text/javascript">

        var notif_container = document.getElementsByClassName("notif-container")[0] , 
        notif_button = document.getElementById("notif-button")

        notif_container.style.display = "none"

        notif_button.onclick = () => {

            no_notifs.style.display = "block"

            if (localStorage.getItem("theme")){
                notif_container.style.backgroundColor = "#000"
                notif_container.style.display = "flex"
            }

            else {
                notif_container.style.backgroundColor = "#fff"
                notif_container.style.display = "flex"
            }

            if (notif_list.innerHTML.trim()){
                no_notifs.style.display = "none"
            }
        }
        
        var notif_close = document.getElementById("notif-close")

        notif_close.onclick = () => {
            notif_container.style.display = "none"
        }

    </script>

    

</div>



