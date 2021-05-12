@extends('layouts.app')

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
            action="{{route('diagnostico.store')}}"
        >
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    SELECCIONAR PACIENTE
                </label>
                <select name='pacientess' class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                    @foreach($paciente as $pacientes)
                        <option value="{{$pacientes->id}}">{{$pacientes->ci}} - {{$pacientes->nombres}} {{$pacientes->apellidos}}</option>
                    @endforeach
                </select>
                @error('pacientes')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="anamnesis">
                    ANAMNESIS
                </label>
                <textarea name="anamnesis" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="Ingresa tu reporte de anamnesis" cols="40" rows="5"></textarea>
                @error('anamnesis')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="enfermedadactual">
                    ENFERMEDAD ACTUAL
                </label>
                <textarea name="enfermedadactual" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="Ingresa la enfermedad actual del paciente" cols="40" rows="5"></textarea>
                @error('enfermedadactual')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="examenfisicogeneral">
                    EXAMEN FISICO GENERAL
                </label>
                <textarea name="examenfisicogeneral" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="Ingresa el examen fisico general" cols="40" rows="5"></textarea>
                @error('examenfisicogeneral')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="examenescomplementarios">
                    EXAMENES COMPLEMENTARIOS
                </label>
                <textarea name="examenescomplementarios" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="Ingresa el examen complementario" cols="40" rows="5"></textarea>
                @error('examenescomplementarios')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="diagnostico">
                    DIAGNOSTICO AL PACIENTE
                </label>
                <textarea name="diagnostico" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="Ingresa el diagnostico del paciente" cols="40" rows="5"></textarea>
                @error('diagnostico')
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
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tratamiento">
                    TRATAMIENTO
                </label>
                <textarea name="tratamiento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" placeholder="Ingresa el tratamiento del paciente" cols="40" rows="5"></textarea>
                @error('tratamiento')
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
                    {{__('Registrar Diagnostico')}}
                </button>
            </div>
        </form>
    </div>
@endsection