
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

        <link rel="stylesheet" type="text/css" href="{{ asset('css/override.css') }}">    


        <div class="content-container flex justify-center">

            <div class = "loading">
                <img src = "{{ asset('loading/loading.gif') }}">
            </div>

            <div class="content-right flex justify-center flex-col h-screen fixed inset-y-0 left-0">
                <x-notifications />
                <div class="ml-4">
                    <button id="dark-theme"
                    class="bg-transparent text-black font-semibold py-2 border-none">Dark</button>
                </div>
            </div>



