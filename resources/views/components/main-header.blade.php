
<div>

    <link rel="stylesheet" type="text/css" href="{{ mix('css/style.css') }}">    

    <style>

        .master-container {
            width : 100vw;
            height: 100vh;
        }

        .content-container { 
            position : relative;
            overflow : hidden !important;
        }

        .loading {
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 6000;
            background: #fff;
        }

        .loading img {
            position: relative;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            height: 50px;
            width: 50px;
            color: #000;
        }

        .unload {
            display: none;
        }

        #dark-theme::before, #notif-button::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free"; 
            font-weight: 400; 
            content: "\f186";
            margin-right : 5px;
        }

        #notif-button::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 400; 
            content: "\f0f3";
        }

        .home, .posts , .search , .requests , .inbox, .connections {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
        }

        .home::before, .posts::before , .search::before , 
        .requests::before , .inbox::before , .connections::before {
            align-self : center;
            color : lightblue;
            margin-right : 5px;
            font-size : 15px;
        }

        .home::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f015";
        }

        .posts::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f304";
        }

        .search::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f002";
        }

        .inbox::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f0e0";
        }

        .requests::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f234";
        }

        .connections::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            content: "\f0c0";
        }

    </style>

    <template id="dark-bg">

        <style id="dark-bg-style">

            #dark-theme::before {
                font-family: "Font Awesome 5 Free"; 
                font-weight: 400; 
                content: "\f185";
                margin-right : 5px;
            }

        </style>

    </template>

    <div class="master-container">

        <div class="flex justify-center content-container">

            <div class = "loading">
                <img src = "{{ asset('loading/loading.gif') }}">
            </div>

            <div class="flex justify-center flex-col h-screen fixed inset-y-0 left-0">
                <x-notifications />
                <div class="ml-4">
                    <button id="dark-theme"
                    class="bg-transparent text-black font-semibold py-2 border-none">Dark</button>
                </div>
            </div>



