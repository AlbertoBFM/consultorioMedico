<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Consultorio Gessba') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
    .flota{
        animation: port 5.0s ease-in-out;
        animation-iteration-count: infinite;
    }
    @keyframes port{
        0%{
            transform: scale(1);
        }
        50%{
            transform: scale(1.05);
        }
        100%{
            transform: scale(1);
        }
    }
    </style>
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
<div class="flex flex-col">
    @if(Route::has('login'))
        <div class="absolute top-0 right-0 mt-4 mr-4 space-x-4 sm:mt-6 sm:mr-6 sm:space-x-6">
            @auth
                <a href="{{ url('/home') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase flota">{{ __('Principal') }}</a>
            @else
                <a href="{{ route('login') }}" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase flota">{{ __('Iniciar Sesión') }}</a>
            @endauth
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center">
        <div class="flex flex-col justify-around h-full">
            <div style="width: 70vw;
                        height: 75vh;
                        background-image: linear-gradient(
                            rgba(35, 56, 118, 0.7),
                            rgba(35, 56, 118, 0.7)
                        ),url(https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Vista_panorámica_de_Potosí.jpg/1000px-Vista_panorámica_de_Potosí.jpg);
                        background-position: center;
                        background-size: cover;
                        background-repeat: no-repeat;
                        position: relative;
                        border-radius: 5px;
                        box-shadow: 5px 5px 30px black;
                        "
                class="flex d-flex justify-center items-center"
            >
                <h1 style="width:40%""
                    class="titulo mb-6 text-white text-center bold tracking-wider text-4xl sm:mb-8 sm:text-6xl flota">
                    {{ config('app.name', 'Consultorio Gessba') }}
                </h1>
                <img style="width:40%"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/35/Escudo_de_Potosí.svg/1200px-Escudo_de_Potosí.svg.png" alt=""
                    class="flota"
                >
                <!-- <ul class="flex flex-col space-y-2 sm:flex-row sm:flex-wrap sm:space-x-8 sm:space-y-0">
                    <li>
                        <a href="https://laravel.com/docs" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Documentation">Documentation</a>
                    </li>
                    <li>
                        <a href="https://laracasts.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Laracasts">Laracasts</a>
                    </li>
                    <li>
                        <a href="https://laravel-news.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="News">News</a>
                    </li>
                    <li>
                        <a href="https://nova.laravel.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Nova">Nova</a>
                    </li>
                    <li>
                        <a href="https://forge.laravel.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Forge">Forge</a>
                    </li>
                    <li>
                        <a href="https://vapor.laravel.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Vapor">Vapor</a>
                    </li>
                    <li>
                        <a href="https://github.com/laravel/laravel" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="GitHub">GitHub</a>
                    </li>
                    <li>
                        <a href="https://tailwindcss.com" class="no-underline hover:underline text-sm font-normal text-teal-800 uppercase" title="Tailwind Css">Tailwind CSS</a>
                    </li>
                </ul> -->
            </div>
        </div>
    </div>
</div>
</body>
</html>
