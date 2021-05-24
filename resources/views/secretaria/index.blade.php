@extends("layouts.app")
@section('content')

@if(session('success'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Felicidades!</strong>
        <span class="block sm:inline">{{session("success")}}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
        </span>
    </div>
@endif

<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">{{ __("Lista de Secretarias") }}</h1>
        <a href="{{ route('secretaria.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded">
            {{ __("Registrar Secretaria") }}
        </a>
    </div>
</div>
<!-- BUSQUEDA -->
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <form
        action="{{ route('secretaria.index') }}"
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
            {{ __("Turno") }}
        </label>
        <input name="turno2" value="{{ $turno2 }}" list="turnoo2" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
        <datalist id="turnoo2">
            <option value="{{ __('08:30 - 14:30') }}">
            <option value="{{ __('14:30 - 20:30') }}">
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
    <a href="{{ route('descargarPDFSecretarias') }}" target="_blank" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mt-4 border border-blue-500 hover:border-transparent rounded">
        {{ __("Generar Reporte") }}
    </a>
</div>
<br>
<!-- LISTAS -->
<table class="border-collapse border text-center border-gray-500 mt-4" style="width:100%">
    <thead>
        <tr>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("CI") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("APELLIDOS") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("NOMBRES") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("FECHA DE  NACIMIENTO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("CELULAR") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("SALARIO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("TURNO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("OPCIONES") }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($secretarias as $secretaria)
            <tr>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->ci }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->apellidos }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->nombres }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->f_nac }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->cel }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->salarios->Salario }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->turnos }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">
                    <div class="inline-flex">
                        <a href="{{ route('secretaria.edit', $secretaria) }}"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"
                        >
                            {{ __("Modificar") }}
                        </a>
                        <a
                            href="#"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
                            onclick="
                                event.preventDefault();
                                document.getElementById('delete-secretaria-{{ $secretaria->id }}-form').submit();
                            "
                        >
                            {{ __("Eliminar") }}
                        </a>
                        <form
                            id="delete-secretaria-{{ $secretaria->id }}-form"
                            method="POST"
                            action="{{ route('secretaria.destroy', ['secretarium' => $secretaria]) }}"
                            class="hidden"
                        >
                            @method("DELETE")
                            @csrf
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="border-solid border-2 border-gray-500 px-4 py-2" colspan="5">
                    {{ __("LISTA DE MÉDICOS VACIA") }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection
