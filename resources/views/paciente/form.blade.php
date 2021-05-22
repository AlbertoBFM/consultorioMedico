@extends('layouts.pacientes')
@section('content')
<div class="w-full max-w-xs mt-20 m-auto">
        <form
            class="bg-white shadow-md rounded px-8 pt-10 pb-8 mb-4"
            method="POST"
            action="{{$ruta}}"
        >
            @csrf

            @isset($update)
                @method('PUT')
            @endisset

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    CARNET DE IDENTIDAD
                </label>
                <input name="carnetidentidad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="{{$ci}}">
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    NOMBRES
                </label>
                <input name="nombres" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="{{$nombre}}">
                @error('nombres')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    APELLIDOS
                </label>
                <input name="apellidos" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="{{$apellido}}">
                @error('apellidos')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    FECHA DE NACIMIENTO
                </label>
                @if(isset($actualizar2))
                    <input type="date" value="{{$actualizar2}}" name="fechanacimiento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                @else
                    <input type="date" name="fechanacimiento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username">
                @endif
                @error('fechanacimiento')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    SEXO
                </label>
                <select name='sexo' class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    @isset($actualizar)
                        @if($actualizar=='M')
                            <option selected="true" disabled="disabled">{{ __('FEMENINO') }}</option>
                        @else
                            <option selected="true" disabled="disabled">{{ __('MASCULINO') }}</option>
                        @endif
                    @endisset
                    <option value="V">MASCULINO</option>
                    <option value="M">FEMENINO</option>
                </select>
                @error('sexo')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    CELULAR
                </label>
                <input name="celular" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="number" placeholder="{{$celular}}">
                @error('celular')
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
            <div class="flex items-center justify-between">
                <button type="submit" class="transition duration-500 ease-in-out hover:bg-red-600 transform hover:scale-102 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    {{$boton}}
                </button>
            </div>
        </form>
    </div>
@endsection
