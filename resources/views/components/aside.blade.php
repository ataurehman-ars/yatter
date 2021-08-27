
<div class="flex items-center h-screen fixed inset-y-0 right-0">
    <style></style>
    <div class="weather-container">
        <div class="mb-4 search-city">
            <input type="text" name="search" id="weather-city" placeholder="search city" class="block shadow-lg border-transparent rounded mr-2">
        </div>

        <div class="">
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


