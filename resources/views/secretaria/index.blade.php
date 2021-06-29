@extends("layouts.app")
@section('content')

<div class="flex justify-center flex-wrap bg-gray-200 p-4">
    <div class="text-center">
        <h1 class="mb-10 text-4xl">{{ __("Lista de Secretarias") }}</h1>
        <a href="{{ route('secretaria.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-5 border border-blue-500 hover:border-transparent rounded">
            {{ __("Registrar Secretaria") }}
        </a>
    </div>
</div>
<!-- BUSQUEDA -->
<div class="flex justify-center flex-wrap bg-gray-200 p-4">
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
        <input name="turno3" value="{{ $turno3 }}" list="turnoo3" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
        <datalist id="turnoo3">
            <option value="{{ __('08:30 - 14:30') }}">
            <option value="{{ __('14:30 - 20:30') }}">
        </datalist>

        <input
            type="submit"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4border border-blue-500 hover:border-transparent rounded"
            value="Buscar"
        >

    </div>
    </form>
    <!-- REPORTE -->
<div class=" w-full flex justify-center flex-wrap mt-0">
    <form
        action="{{ route('descargarPDFSecretarias') }}"
        method="GET"
    >
        <input type="hidden" name="ci2" value="{{ $ci }}">
        <input type="hidden" name="nombre2" value="{{ $nombre }}">
        <input type="hidden" name="apellido2" value="{{ $apellido }}">
        <input type="hidden" name="turno32" value="{{ $turno3 }}">
        <input
            type="submit"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded"
            value="Generar PDF"
        >
    </form>
</div>
</div>
<br>
<!-- LISTAS -->
<div class="container mx-auto">
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
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $secretaria->turnos->turnos }}</td>
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
                            action="{{ route('secretaria.destroy',  $secretaria) }}"
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
</div>
@endsection
