@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informacion</p>
        <p class="text-sm">{{session("success")}}</p>
    </div>
@endif
    <div class="w-9/12 max-w mt-15 m-auto">

        <form
            class="bg-white shadow-md rounded px-8 pt-10 pb-8 mb-4"
            method="POST"
            action="{{route('consulta.store')}}"
        >
            @csrf
            <div class="flex items-center justify-between mb-5">
                <a href="{{route('paciente.create')}}" class="transition duration-500 ease-in-out hover:bg-red-600 transform hover:scale-102 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{__('Registrar Paciente')}}
                </a>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="motivoconsulta">
                    MOTIVO DE LA CONSULTA
                </label>
                <input name="motivoconsulta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Ingresa un motivo">
                @error('motivoconsulta')
                <p class="text-red-500 font-bold text-xs italic">{{ __("Solo se permiten Letras") }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    SELECCIONAR PACIENTE
                </label>
                <input name="pacientess" list="pacientess" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Digita el nombre del paciente">
                <datalist id="pacientess">
                    @foreach($paciente as $pacientes)
                        <option value="{{$pacientes->ci}}">
                    @endforeach
                </datalist>
                @error('pacientess')
                    <p class="text-red-500 font-bold text-xs italic">{{ __("CI no valido") }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                    TIPO DE LA CONSULTA
                </label>
                <div class="block" id="tipo">
                    <div class="my-5 flex">
                        <div class="mr-10">
                            <label class="inline-flex items-center">
                                <input id="general" type="radio" class="form-radio" name="tipo" value="1" checked>
                                <span class="ml-2">General</span>
                            </label>
                        </div>
                        <div class="mr-10">
                            <label class="inline-flex items-center">
                                <input id="domicilio" type="radio" class="form-radio" name="tipo" value="3">
                                <span class="ml-2">Domicilio</span>
                            </label>
                        </div>
                        <div class="mr-10">
                            <label class="inline-flex items-center">
                                <input id="emergencia" type="radio" class="form-radio" name="tipo" value="4">
                                <span class="ml-2">Emergencia</span>
                            </label>
                        </div>
                        <div class="mr-10">
                            <label class="inline-flex items-center">
                                <input id="especialidad" type="radio" class="form-radio" name="tipo" value="5">
                                <span class="ml-2">Especialidad</span>
                            </label>
                        </div>
                        <div class="mr-10">
                            <label class="inline-flex items-center">
                                <input id="reconsulta_e" type="radio" class="form-radio" name="tipo" value="21">
                                <span class="ml-2">Reconsulta Especialidad</span>
                            </label>
                        </div>
                        <div class="mr-10">
                            <label class="inline-flex items-center">
                                <input id="reconsulta_g" type="radio" class="form-radio" name="tipo" value="22">
                                <span class="ml-2">Reconsulta General</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-4 flex w-full justify-center w-80">
                <div id="me" class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="medico">
                        MEDICOS ESPECIALISTAS
                    </label>
                    <select name='medico_esp' class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        @foreach($medicosEspecialistas as $medicoEspecialista)
                            <option value="{{$medicoEspecialista->id}}">
                                {{$medicoEspecialista->nombres}} {{$medicoEspecialista->apellidos}}
                                -
                                {{ $medicoEspecialista->nombre_especialidad }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div id="mt" class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="medico">
                        MEDICO GENERAL
                    </label>
                    <input type="text" value="{{ $medicoTurno[0]->nombres }} {{ $medicoTurno[0]->apellidos }}" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" disabled></input>
                    <input type="hidden" name='medico_turno' value="{{ $medicoTurno[0]->id }}">
                </div>
                <div id="mg" class="flex-1">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="medico">
                        MEDICOS GENERALS
                    </label>
                    <select name='medico_gen' class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                        @foreach($medicosGenerales as $medicoGeneral)
                            <option value="{{$medicoGeneral->id}}">
                                {{$medicoGeneral->nombres}} {{$medicoGeneral->apellidos}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- FECHA -->
            <div id="fecha" class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="inline-password">
                        {{ __("FECHA CONSULTA") }}
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-80 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="f_nac"
                        name="f_nac"
                        type="date"
                        value="{{ $fechaMinima }}"
                        min="{{ $fechaMinima }}"
                        max="{{ $fechaMaxima }}"
                    >
                    @error("f_nac")
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="transition duration-500 ease-in-out hover:bg-red-600 transform hover:scale-102 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{__('Registrar consulta')}}
                </button>
            </div>


        </form>
    </div>
    <script defer>
        document.getElementById('me').style.display = 'none';
        document.getElementById('mg').style.display = 'none';
        document.getElementById('tipo').addEventListener("click", () => {
            if (document.getElementById('general').checked) {
                document.getElementById('mt').style.display = 'block';
                document.getElementById('me').style.display = 'none';
                document.getElementById('mg').style.display = 'none';
                document.getElementById('fecha').style.display = 'block';
            }
            else if(document.getElementById('reconsulta_e').checked){
                document.getElementById('mt').style.display = 'none';
                document.getElementById('me').style.display = 'block';
                document.getElementById('mg').style.display = 'none';
                document.getElementById('fecha').style.display = 'none';
            }
            else if(document.getElementById('reconsulta_g').checked){
                document.getElementById('mt').style.display = 'none';
                document.getElementById('me').style.display = 'none';
                document.getElementById('mg').style.display = 'block';
                document.getElementById('fecha').style.display = 'block';
            }
            else if(document.getElementById('domicilio').checked){
                document.getElementById('mt').style.display = 'none';
                document.getElementById('me').style.display = 'none';
                document.getElementById('mg').style.display = 'block';
                document.getElementById('fecha').style.display = 'block';
            }
            else if(document.getElementById('emergencia').checked){
                document.getElementById('mt').style.display = 'block';
                document.getElementById('me').style.display = 'none';
                document.getElementById('mg').style.display = 'none';
                document.getElementById('fecha').style.display = 'none';
            }
            else{
                document.getElementById('mt').style.display = 'none';
                document.getElementById('me').style.display = 'block';
                document.getElementById('mg').style.display = 'none';
                document.getElementById('fecha').style.display = 'none';
            }

        });
    </script>
@endsection

