<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <title>TheMoviebook</title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        {{--<style>
            body {
                background: url("/img/bg.jpg") fixed;
                background-size: 40%;
                background-position: center;
            }
            html, body {margin: 0; height: 100%; overflow: hidden}
            div.shapeTopBar
            {
                background: #2433FE;
                width:100%;
                height:5%;
                position: relative;
                z-index: 1000;
                -webkit-filter: drop-shadow(8px -8px 10px black); /* Safari */
                filter: drop-shadow(8px -8px 15px black);
            }
            div.shapeBottom {
                width: 100%;
                height: 65%;
                -webkit-transform: skewy(10deg);z
                -moz-transform: skewy(10deg);
                transform: skewy(10deg);
                background: #CECECE;
                margin-top: 37%;
                position:absolute;
                -webkit-filter: drop-shadow(8px 8px 10px black); /* Safari */
                filter: drop-shadow(8px 8px 15px black);
            }
            div.shapeTop {
                 width: 100%;
                 height: 65%;
                 -webkit-transform: skewy(10deg);
                 -moz-transform: skewy(10deg);
                 transform: skewy(10deg);
                 background: #CECECE;
                 margin-top: -30%;
                -webkit-filter: drop-shadow(8px -8px 10px black); /* Safari */
                filter: drop-shadow(8px -8px 15px black);
             }

            div.title {
                color: #2433FE;
                left: 1.5%;
                bottom: 0%;
                font-size: 600%;
                -webkit-filter: drop-shadow(0px -0px 5px black); /* Safari */
                filter: drop-shadow(0px -0px 5px black);
                font-family: "Arial Black";
                position: fixed;
            }


            .menu {
                color: white
            }
        </style>--}}

    </head>




    <body class="filmes-bg">




    <div class="shapeTopBar">
        <div class="menu">
                <a href="login">Entrar</a>
                <a href="register">Registrar</a>
        </div>

    </div>




    <div class="shapeTop">
    </div>




    <div class="shapeBottom">
    </div>




    <div class="title">
        TheMoviebook
    </div>





    </body>
</html>
