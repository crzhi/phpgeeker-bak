<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                @auth
                    <a href="">Home</a>
                @else
                    <a href="">Login</a>
                    <a href="">Register</a>
                @endauth
            </div>
            <div class="content">
                <div class="title m-b-md">PHP Geeker</div>
                <div class="links">
                    <a href="{{ modules_domain('www') }}">WWW</a>
                    <a href="{{ modules_domain('bbs') }}">BBS</a>
                    <a href="{{ modules_domain('blog') }}">BLOG</a>
                    <a href="{{ modules_domain('book') }}">BOOK</a>
                    <a href="{{ modules_domain('game') }}">GAME</a>
                    <a href="{{ modules_domain('mall') }}">MALL</a>
                    <a href="{{ modules_domain('nav') }}">NAV</a>
                    <a href="{{ modules_domain('admin') }}">ADMIN</a>
                </div>
            </div>
        </div>
    </body>
</html>
