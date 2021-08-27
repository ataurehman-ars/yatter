
onload = () => {

    document.getElementsByClassName("loading")[0].style.display = "none"
    document.getElementsByClassName("loading")[0].style.overflow = "scroll"

    var main = document.querySelector("main").parentElement , 
    nav = document.querySelector("nav") , 
    content  = document.getElementsByClassName("content-container")[0]

    var containers = [content , nav , main]

    var texts = document.querySelectorAll(`*:not(button)`)
    Array.from(texts).forEach(text => text.style.color = "#333333")

    var textareas = document.getElementsByTagName("textarea") , 
    text_inputs = document.querySelectorAll(`input[type="text"]`) 

    var imgs = document.getElementsByTagName("img")

    const texts_unchange = () => {

        Array.from(textareas).forEach(textarea => {
            textarea.style.color = "#000"
            textarea.style.fontWeight = "bold"
        })

        Array.from(text_inputs).forEach(input => {
            input.style.color = "#000"
            input.style.fontWeight = "bold"
        })

        Array.from(imgs).forEach(img => img.style.backgroundColor = "#fff")
    }

    texts_unchange()

    main.style.backgroundColor = "transparent"
    nav.style.backgroundColor = "transparent"

    Array.from(document.querySelectorAll("nav a"))
    .forEach(a => a.style.color = "#000")



    var dark_bg = document.getElementById("dark-bg") , 
    dark_button = document.getElementById("dark-theme")

    dark_button.onclick = () => changeTheme() 

    if(localStorage.getItem('theme')){
        changeTheme()
    }

    function changeTheme(){

        if (dark_button.textContent.toLowerCase() === "light"){

            dark_button.textContent = "Dark"

            Array.from(containers).forEach(container => {
                container.style.backgroundColor = "transparent"
            })

            Array.from(texts).forEach(text => text.style.color = "#333333")

            if(main.contains(document.getElementById("dark-bg-style"))){
                main.removeChild(document.getElementById("dark-bg-style"))
            }

            localStorage.removeItem("theme")
            texts_unchange()
            dark_button.style.color = "#000"

            return 
        }
        
        Array.from(containers).forEach(container => {
            container.style.backgroundColor = "#000"
        })

        Array.from(texts).forEach(text => text.style.color = "#a6a6a6")

        dark_button.textContent = "Light"
        dark_button.style.color = "#fff"

        main.appendChild(dark_bg.content.cloneNode(true))

        localStorage.setItem("theme" , "dark")
        texts_unchange()

    }

}



