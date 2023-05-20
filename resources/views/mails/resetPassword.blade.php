<!DOCTYPE html>
<html lang="{{  app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name')}}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel='stylesheet' href="{{URL::asset('assets\css\auth_style.css')}}">

        <style>

            .container {
                background-color: whitesmoke;
                min-height: 100vh;
                padding: 45px;
                width:90%;
            }

            .container-body {
                width: 85%;
                background-color: white;
                min-height: 80vh;
                margin: auto;
            }
            .logo {
                width: 40%;
                margin: auto;
                padding: 15px;
            }
            .image-icon {
                width: 100%;
                display: block;
            }
            .welcome {
                margin: 80px 0 60px 0;
            }
            .welcome h1 {
                text-align: center;
                text-transform: capitalize;
                font-weight: bold;
                font-size: 44px;
                color: #707070;
            }
             
            p {
                color: #666666;
                text-align: center;
                font-size: 19px;
            }

            .code {
               text-align: center;
               text-transform: capitalize;
               font-size: 23px;
               font-weight: bold;
               color: #707070;
            }
            .code>span {
                padding: 10px;
                display: inline-block;
                color: brown;
                font-size: 30px;
                font-weight: 700;
            }

            .notice {
                padding: 10px;
                margin: 20px 0 30px
            }
            .notice > p > mark {
                color: brown;
            }
        </style>
    </head>
    <body class="font-sans antialiased">

        <div class="container">
            <div class='container-body'>

                <div class="logo">
                    <img src="{{URL::asset('assets\images\logo-dark.png')}}" alt="not found" class="image-icon" draggable="false">
                    
                </div>
                <div class="welcome">
                    <h1>welcome!</h1>
                </div>

                <p>Just one more step to begin your journey.</p>

                <div class='code'>
                    code : <span>{{$code}}</span>
                </div>

                <div class="notice">
                    <p>If you didn't create <mark >admin</mark> account, just delete this email.</p>
                </div>

            </div>
            
        </div>

    </body>
</html>