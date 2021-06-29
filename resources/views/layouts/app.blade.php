<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Consultas Médicas') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <div id="app">
        <header class="bg-blue-900 py-6">
            <div class="container mx-auto flex justify-between items-center px-6">
                <div>
                    <a href="{{ url('/home') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Consultorio Gessba') }}
                    </a>
                    @if(isset(Auth::user()->jefemedico_id))
                        <a
                            href="{{ route('medico.index') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Medicos") }}
                        </a>
                        <a
                            href="{{ route('secretaria.index') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Secretarias") }}
                        </a>
                        <a
                            href="{{ route('especialidad.index') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Especialidades") }}
                        </a>
                    @elseif(isset(Auth::user()->medico_id))
                        <a
                            href="{{ route('indexTurno') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Consultas Pendientes") }}
                        </a>
                        <a
                            href="{{ route('diagnostico.index') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Consultas") }}
                        </a>
                    @elseif(isset(Auth::user()->secretaria_id))
                        <a
                            href="{{ route('paciente.index') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Pacientes") }}
                        </a>
                        <a
                            href="{{ route('consulta.index') }}"
                            class="ml-10 no-underline hover:underline text-gray-300 text-sm sm:text-base"
                        >
                            {{ __("Consultas") }}
                        </a>
                    @endif
                </div>
                <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                    @guest
                        <a class="no-underline hover:underline" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                        <!-- @if (Route::has('register'))
                            <a class="no-underline hover:underline" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif -->
                    @else
                        <span>{{ Auth::user()->email }}</span>
                        <a href="{{ route('logout') }}"
                           class="no-underline hover:underline"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">{{ __('Cerrar Sesión') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                    @endguest
                </nav>
            </div>
        </header>
        @if(session('danger'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Error!</strong>
                <span class="block sm:inline">{{session("danger")}}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">¡Exito!</strong>
                <span class="block sm:inline">{{session("success")}}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        @endif
        @yield('content')
    </div>
</body>
</html>
