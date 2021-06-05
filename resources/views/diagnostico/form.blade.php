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
            action="{{ $route }}"
        >
            @csrf
            @isset($update)
                @method("PUT")
            @endisset
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    {{ __("PACIENTE") }}
                </label>
                <input
                    type="text"
                    name="pacientess"
                    id="username"
                    disabled
                    @isset($consulta)
                        value="{{ $consulta[0]->nombres }} {{ $consulta[0]->apellidos }}"
                    @else
                        value="{{ $diagnostico[0]->consultas->paciente->nombres }} {{ $diagnostico[0]->consultas->paciente->apellidos }}"
                    @endisset
                >
                @isset($consulta)
                    <input type="hidden" name="pacientess" value="{{ $consulta[0]->paciente_id }}">
                    <input type="hidden" name="consulta" value="{{ $consulta[0]->id }}">
                @endisset
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="anamnesis">
                    ANAMNESIS
                </label>
                <textarea
                    name="anamnesis"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    placeholder="Ingresa tu reporte de anamnesis"
                    cols="40"
                    rows="5"
                    @isset($diagnostico)
                        value="{{ $diagnostico[0]->Anamnesis }}"
                    @endisset
                >@isset($diagnostico){{ $diagnostico[0]->Anamnesis }} @endisset</textarea>
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
                <textarea
                    name="enfermedadactual"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    placeholder="Ingresa la enfermedad actual del paciente"
                    cols="40"
                    rows="5"
                    @isset($diagnostico)
                        value="{{ $diagnostico[0]->Enfermedad_Actual }}"
                    @endisset
                >@isset($diagnostico) {{ $diagnostico[0]->Enfermedad_Actual }} @endisset</textarea>
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
                <textarea
                    name="examenfisicogeneral"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    placeholder="Ingresa el examen fisico general"
                    cols="40"
                    rows="5"
                    @isset($diagnostico)
                        value="{{$diagnostico[0]->Examen_Fisico_General}}"
                    @endisset
                >@isset($diagnostico) {{$diagnostico[0]->Examen_Fisico_General}} @endisset</textarea>
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
                <textarea
                    name="examenescomplementarios"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    placeholder="Ingresa el examen complementario"
                    cols="40"
                    rows="5"
                    @isset($diagnostico)
                        value="{{ $diagnostico[0]->Examenes_complementarios }}"
                    @endisset
                >@isset($diagnostico) {{ $diagnostico[0]->Examenes_complementarios }} @endisset</textarea>
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
                <textarea
                    name="diagnostico"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    placeholder="Ingresa el diagnostico del paciente"
                    cols="40"
                    rows="5"
                    @isset($diagnostico)
                        value="{{ $diagnostico[0]->Diagnostico }}"
                    @endisset
                >@isset($diagnostico) {{ $diagnostico[0]->Diagnostico }} @endisset</textarea>
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
                <textarea
                    name="tratamiento"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username"
                    placeholder="Ingresa el tratamiento del paciente"
                    cols="40"
                    rows="5"
                    @isset($diagnostico)
                        value="{{ $diagnostico[0]->Tratamiento }}"
                    @endisset
                >@isset($diagnostico) {{ $diagnostico[0]->Tratamiento }} @endisset</textarea>
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
                    {{ $button }}
                </button>
            </div>
        </form>
    </div>
@endsection
