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
<table class="border-collapse border text-center border-gray-500 mt-4" style="width:100%">
    <thead>
        <tr>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("MOTIVO DE LA CONSULTA") }}</th>
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
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->medico_id }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $consulta->paciente_id }}</td>
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
