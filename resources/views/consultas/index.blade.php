@extends("layouts.app")
@section('content')
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">{{ __("Lista de Consultas") }}</h1>
        <a href="{{ route('consulta.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded">
            {{ __("Registrar Consulta") }}
        </a>
    </div>
</div>
<!-- BUSQUEDA -->
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <form
        action="{{ route('consulta.index') }}"
        method="GET"
    >
    <div class="md:flex md:items-center mb-6">
        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            Motivo Consulta
        </label>
        <input type="text" name="mot" value="{{ $mot }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            CI Médico
        </label>
        <input type="text" name="cimedico" value="{{ $cimedico }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            CI Paciente
        </label>
        <input type="text" name="cipaciente" value="{{ $cipaciente }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

        <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
            Tipo Consulta
        </label>
        <input name="tipo2" value="{{ $tipo2 }}" list="tipoo" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
        <datalist id="tipoo">
            @foreach($tipos as $tipoconsulta)
                <option value="{{ $tipoconsulta->nombre_especialidad }}">
            @endforeach
        </datalist>

        <label for="turno" class="block font-bold md:text-right mb-1 md:mb-0 pr-4">
            {{ __("Atendido") }}
        </label>
        <input name="resp" value="{{ $resp }}" list="respp" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
        <datalist id="respp">
            <option value="{{ __('SI') }}">
            <option value="{{ __('NO') }}">
        </datalist>

        <input
            type="submit"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded"
            value="Buscar"
        >

    </div>
    </form>
</div>
<div class="flex justify-center flex-wrap">
    <a href="{{ route('descargarPDFConsultas') }}" target="_blank" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 mt-4 border border-blue-500 hover:border-transparent rounded">
        {{ __("Generar Reporte") }}
    </a>
</div>
<table class="border-collapse border text-center border-gray-500 mt-4" style="width:100%">
    <thead>
        <tr>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("MOTIVO DE LA CONSULTA") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("FECHA") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("MEDICO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("PACIENTE") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("TIPO DE CONSULTA") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("ATENDIDO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("OPCIONES") }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($consultas as $consulta)
            <tr>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->motivo_consulta }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->fecha }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->medico->ci }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->paciente->ci }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">
                    {{ $consulta->tipos->especialidades->nombre_especialidad}}
                </td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->atentido }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">
                    <div class="inline-flex">
                        <a href="{{ route('consulta.edit', ['consultum' => $consulta]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                            {{ __("Modificar") }}
                        </a>
                        <a
                            href="#"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
                            onclick="
                                event.preventDefault();
                                document.getElementById('delete-consulta-{{ $consulta->id }}-form').submit();
                            "
                        >
                            {{ __("Eliminar") }}
                        </a>
                        <form
                            id="delete-consulta-{{ $consulta->id }}-form"
                            method="POST"
                            action="{{ route('consulta.destroy', ['consultum' => $consulta]) }}"
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
