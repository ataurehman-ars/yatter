
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href = "{{ asset('css/background.css') }}" type="text/css">
    <title>Yatter!</title>
</head>

<style>
    body {
        padding : 0;
        margin : 0;
        width : 100vw;
        height : 100vh;
    }

    .loading {
            width: 100vw;
            height: 100vh;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 50000;
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

    .title-container {
        position : absolute;
        z-index : 6000;
        background : transparent;
        top : 50%;
        left : 50%;
        transform : translate(-50%, -50%);
    }

    h1 , h2, p, a {
        color : #fff;
        font-family : Candara;
        margin : auto;
    }

    h1 {
        font-size : calc(25px + 20vw);
    }

    h2, p, a {
        text-align: center;
        font-weight : lighter;
    }

    a {
        display : block;
        margin-top : calc(10px + 1vw);
        text-decoration : none;
        background : #fff;
        color : #000;
        width : 50%;
        border-radius : 20px;
        padding : 10px 0;
        font-weight : bolder;
    }

        
</style>

    <body>

        <div class = "loading">
            <img src = "{{ asset('loading/loading.gif') }}">
        </div>

        <div class="master-container">

            <div class="title-container">
                <h1>Yatter!</h1>
                <h2>Welcome to Yatter</h2>
                <p>A place to share little ideas</p>
                <a href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </body>

    <script type="text/javascript">

        onload = () => {
            document.getElementsByClassName("loading")[0].style.display = "none"
        }
    </script>
</html>


