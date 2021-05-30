@extends('layouts.pacientes')
@section('content')
@if(session('success'))
    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3" role="alert">
        <p class="font-bold">Informacion</p>
        <p class="text-sm">{{session("success")}}</p>
    </div>
@endif
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">
            {{__("Listado de Pacientes")}}
        </h1>
        <a href="{{ ROUTE('paciente.create')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{__("CREAR PACIENTE")}}
        </a>
    </div>
</div>
<!-- BUSQUEDA -->
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <form
        action="{{ route('paciente.index') }}"
        method="GET"
    >
    <div class="md:flex md:items-center mb-6">
        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            CI
        </label>
        <input type="text" name="ci" value="{{ $ci }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            Nombre
        </label>
        <input type="text" name="nombre" value="{{ $nombre }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            Apellido
        </label>
        <input type="text" name="apellido" value="{{ $apellido }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

        <label for="turno" class="block font-bold md:text-right mb-1 md:mb-0 pr-4">
            {{ __("Sexo") }}
        </label>
        <input name="sexo2" value="{{ $sexo2 }}" list="sexoo" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
        <datalist id="sexoo">
            <option value="{{ __('M') }}">
            <option value="{{ __('F') }}">
        </datalist>

        <input
            type="submit"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded"
            value="Buscar"
        >

    </div>
    </form>
</div>
<!-- REPORTE -->
<div class="flex justify-center flex-wrap">
    <a href="{{ route('descargarPDFPacientes') }}" target="_blank" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mt-4 border border-blue-500 hover:border-transparent rounded">
        {{ __("Generar Reporte") }}
    </a>
</div>
<br>
<table class="border-separate border-2 text-center border-gray-500 mt-4" style="width:100%">
    <thead>
        <tr>
        <th class="px-4 py-2">{{__("Carnet de Identidad")}}</th>
            <th class="px-4 py-2">{{__("Nombres")}}</th>
            <th class="px-4 py-2">{{__("Apellidos")}}</th>
            <th class="px-4 py-2">{{__("Fecha de Nacimiento")}}</th>
            <th class="px-4 py-2">{{__("Sexo")}}</th>
            <th class="px-4 py-2">{{__("Celular")}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pacientes as $paciente)
            <tr>
                <td class="border-solid border-2 border-gray px-4 py-2">{{$paciente->ci}}</td>
                <td class="border-solid border-2 border-gray px-4 py-2">{{$paciente->nombres}}</td>
                <td class="border-solid border-2 border-gray px-4 py-2">{{$paciente->apellidos}}</td>
                <td class="border-solid border-2 border-gray px-4 py-2">{{$paciente->f_nac}}</td>
                <td class="border-solid border-2 border-gray px-4 py-2">{{$paciente->sexo}}</td>
                <td class="border-solid border-2 border-gray px-4 py-2">{{$paciente->cel}}</td>
                <td class="border-solid border-2 border-gray px-4 py-2">
                <div class="inline-flex">
                    <a
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"
                        href="{{ route('paciente.edit',['paciente'=>$paciente])}}"
                    >
                        {{ __("Modificar") }}
                    </a>

                    <a
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
                        href="#"
                        onclick="
                            event.preventDefault();
                            document.getElementById('borrar-paciente-{{ $paciente->id }}-form').submit();
                        "
                    >{{ __("Eliminar") }}</a>
                    <form
                        id="borrar-paciente-{{ $paciente->id }}-form"
                        method="POST"
                        action="{{ route('paciente.destroy', ['paciente' => $paciente]) }}"
                        class="hidden"
                    >
                        @method("DELETE")
                        @csrf
                    </form>
                </div>
                </td>
            </tr>
        @empty
            <tr class="border-solid border-2 border-gray-500 px-4 py-2" colspan="5">
                <td>
                    {{__("No hay nada que mostrar")}}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
    @if($pacientes->count())
        <div class="mt-4">
            {{$pacientes->links()}}
        </div>
    @endif
@endsection
