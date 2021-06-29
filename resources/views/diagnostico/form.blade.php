@extends('layouts.app')

@section('content')

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
                    rows="1"
                >@isset($diagnostico){{ $diagnostico[0]->Anamnesis }} @endisset</textarea>
                @error('anamnesis')
                    <p class="text-red-500 text-xs italic">{{ __("No se permiten Caracteres Especiales") }}</p>
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
                    rows="1"
                >@isset($diagnostico) {{ $diagnostico[0]->Enfermedad_Actual }} @endisset</textarea>
                @error('enfermedadactual')
                    <p class="text-red-500 text-xs italic">{{ __("No se permiten Caracteres Especiales") }}</p>
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
                    rows="1"
                >@isset($diagnostico) {{$diagnostico[0]->Examen_Fisico_General}} @endisset</textarea>
                @error('examenfisicogeneral')
                    <p class="text-red-500 text-xs italic">{{ __("No se permiten Caracteres Especiales") }}</p>
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
                    rows="1"
                >@isset($diagnostico) {{ $diagnostico[0]->Examenes_complementarios }} @endisset</textarea>
                @error('examenescomplementarios')
                    <p class="text-red-500 text-xs italic">{{ __("No se permiten Caracteres Especiales") }}</p>
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
                    rows="1"
                >@isset($diagnostico) {{ $diagnostico[0]->Diagnostico }} @endisset</textarea>
                @error('diagnostico')
                    <p class="text-red-500 text-xs italic">{{ __("No se permiten Caracteres Especiales") }}</p>
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
                    rows="1"
                >@isset($diagnostico) {{ $diagnostico[0]->Tratamiento }} @endisset</textarea>
                @error('tratamiento')
                    <p class="text-red-500 text-xs italic">{{ __("No se permiten Caracteres Especiales") }}</p>
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
