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
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
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

        @yield('content')
    </div>
</body>
</html>
