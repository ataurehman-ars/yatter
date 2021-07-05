
let csrf_token = document.head.getElementsByTagName("meta")[2].content , 
search = document.getElementById("search")


search.onkeyup = async() => {

    event.preventDefault()

    let search_value = document.getElementById("search").value.trim()

    let data = {
        'search' : search_value
    }
    

    if (search_value){

        await fetch('/user_info' , {
            headers : {
                'Content-Type' : 'application/json' , 
                'Accept' : 'application/json' , 
                'X-CSRF-Token' : csrf_token
            } , 
            method : 'POST' , 
            credentials : 'same-origin' ,
            body : JSON.stringify(data)

        })
        .then(res => res.text())
        .then(txt => { 
            console.clear()
            console.log(JSON.parse(txt))
        })

    }
}


