
<div class="flex items-center h-screen fixed inset-y-0 right-0">
    <style>
        .only-weather {
            display : none;
            transform : rotateZ(90deg);
            margin : 0;
            width : 30px;
        }

        .hide-all {
            width: 100vw;
            height : 100vh;
            background-color : #fff;
        }

        .only-close {
            display : none;
        }

        .only-weather::before, #only-close::before {
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            margin-right : 2px;
            content: "\f0C2";
            color : lightblue;
        }

        #only-close::before {
            font-family: "Font Awesome 5 Free"; 
            font-weight: 900; 
            margin-right : 2px;
            content: "\f057";
            color : red;
        }

        @media(max-width : 800px){
            .weather-container {
                display : none;
            }
            .only-weather  {
                display : flex;
            }
            .only-close {
                display : flex;
            }
        }
    </style>

    <div class="only-weather"><button id="only-w">Weather</button></div>


    <div class="weather-container" id="weather-container">

        <div class="only-close m-4 flex justify-end"><button id="only-close"></button></div>

        <div class="m-4 search-city">
            <input type="text" name="search" id="weather-city" placeholder="search city" class="block shadow-lg border-transparent rounded mr-2">
        </div>

        <div class="m-4">
            <div class="mb-4">
                <p class="font-bold text-2xl city"></p>
            </div>

            <div>
                <div>
                    <p class="font-semibold text-4xl mr-2 temperature"><sup class="text-xl degree">&#176;</sup></p>
                </div>
            </div>

            <div>
                <div class="weather-icon">
                    <img class="h-20 w-20 bg-transparent object-cover rounded mt-4" id="weather-icon" src="{{ asset('icons/13d.png') }}">
                </div>
            </div>

            <div class="mt-4">
                <p class="font-semibold mr-2 feels-like"><sup class="degree">&#176;</sup></p>
                <p class="overview"></p>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('js/weather.js') }}"></script>
</div>


