
var city = document.getElementsByClassName("city")[0] , 
temperature = document.getElementsByClassName("temperature")[0] , 
feels_like = document.getElementsByClassName("feels-like")[0] , 
overview = document.getElementsByClassName("overview")[0] , 
icon = document.getElementById("weather-icon")


async function getWeather(city='karachi'){

    try {
        await fetch(`https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=9cff59340e7de2957185774c2a21b960&units=metric`)
        .then(res => res.text())
        .then(txt => { 
            try {
                var obj = JSON.parse(txt)
            }
            catch(err){
                console.log(err)
            }
            formatWeather(obj)
        })
        .catch(err => {
            console.log(err)
            return
        })
    }
    catch(err) {
        console.log(err)
        return
    }
}


function formatWeather(obj){

    let sup = document.createElement("sup")
    sup.innerHTML = obj.sys.country

    city.textContent = obj.name + " "
    city.appendChild(sup)

    sup = document.createElement("sup")
    sup.innerHTML = "&#176;C"

    temperature.textContent = obj.main.temp
    temperature.appendChild(sup)

    sup = document.createElement("sup")
    sup.innerHTML = "&#176;C"
    sup.classList = ""

    feels_like.textContent = "Feels like "  + obj.main.feels_like 
    feels_like.appendChild(sup)

    overview.textContent = obj.weather[0].description 
    icon.src = "../icons/" + obj.weather[0].icon + ".png"
}


getWeather()


document.getElementById("weather-city").onkeyup = function(){

    if (event.keyCode === 13){
        let city = this.value.trim().toLowerCase()
        if (city){
            getWeather(city)
            return
        }
        getWeather()
    }
}

var weather_container = document.getElementById("weather-container")

document.getElementById("only-w").onclick = () => {
    
    weather_container.style.display = "block"
    weather_container.classList += " hide-all"
}

document.getElementById("only-close").onclick = () => {
    
    weather_container.style.display = "none"
    weather_container.classList = "weather-container"
}


onresize = () => {
    if (innerWidth >= 800){
        weather_container.classList = "weather-container"
    }
}



