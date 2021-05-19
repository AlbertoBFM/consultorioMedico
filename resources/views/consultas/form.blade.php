@extends('layouts.pacientes')

@section('content')
@if(session('success'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informacion</p>
        <p class="text-sm">{{session("success")}}</p>
    </div>
@endif
    <div class="w-full max-w mt-15 m-auto">

        <form
            class="bg-white shadow-md rounded px-8 pt-10 pb-8 mb-4"
            method="POST"
            action="{{route('consulta.store')}}"
        >
            @csrf

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
                @error('carnetidentidad')
                <div role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Ojo!!!
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>Ingresa datos validos (puede que el paciente ya exista)</p>
                    </div>
                </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="motivoconsulta">
                    MOTIVO DE LA CONSULTA
                </label>
                <input name="motivoconsulta" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Ingresa un motivo">
                @error('motivoconsulta')
                <div role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Ojo!!!
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>Ingresa datos validos</p>
                    </div>
                </div>
                @enderror
            </div>



            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tipo">
                    TIPO DE LA CONSULTA
                </label>

                <select name='tipos' class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    @foreach($tipos as $tipoconsulta)
                        <option value="{{$tipoconsulta->id}}">{{$tipoconsulta->nombre_especialidad}} - Bs. {{$tipoconsulta->precio_consulta}}</option>
                    @endforeach
                </select>

                @error('tipo')
                <div role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Ojo!!!
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>Ingresa datos validos</p>
                    </div>
                </div>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="medico">
                    MEDICO
                </label>
                <select name='medicos' class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    @foreach($medicos as $medico)
                        <option
                            value="{{$medico->id}}">
                            {{$medico->nombres}}{{$medico->apellidos}} -
                            @isset($medico->especialidades->nombre_especialidad)
                                {{ $medico->especialidades->nombre_especialidad }}
                            @else
                                {{ __("Medico General") }}
                            @endisset
                            -
                            Turno {{$medico->turnos->turnos}}
                        </option>
                    @endforeach
                </select>
                @error('medicos')
                <div role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        Ojo!!!
                    </div>
                    <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                        <p>Ingresa datos validos (puede que el paciente ya exista)</p>
                    </div>
                </div>
                @enderror
            </div>


            <div class="flex items-center justify-between">
                <button type="submit" class="transition duration-500 ease-in-out hover:bg-red-600 transform hover:scale-102 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{__('Registrar consulta')}}
                </button>
            </div>

            <div class="flex items-center justify-between mt-5">
                <a href="{{route('paciente.index')}}" class="transition duration-500 ease-in-out hover:bg-red-600 transform hover:scale-102 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{__('Registrar Paciente')}}
                </a>
            </div>
        </form>
    </div>
@endsection

