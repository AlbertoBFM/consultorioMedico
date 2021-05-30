@extends("layouts.app")
@section('content')
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">{{ __("Lista de Médicos") }}</h1>
        <a href="{{ route('medico.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded">
            {{ __("Registrar Médico") }}
        </a>
    </div>
    <!-- BUSQUEDA -->
<div class="flex justify-center flex-wrap bg-gray-200 p-4 mt-5">
    <form
        action="{{ route('medico.index') }}"
        method="GET"
    >
        <div class="md:flex md:items-center ">
            <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                CI
            </label>
            <input type="text" name="ci" value="{{ $ci }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

            <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Apellido
            </label>
            <input type="text" name="apellido" value="{{ $apellido }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

            <label class="block font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-full-name">
                Nombre
            </label>
            <input type="text" name="nombre" value="{{ $nombre }}" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">

            <label for="especialidad" class="block font-bold md:text-right mb-1 md:mb-0 pr-4">
                {{ __("Especialidad") }}
            </label>
            <input name="especialidad" value="{{ $especialidad }}" list="especialidadd" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
            <datalist id="especialidadd">
                <option value="{{ __('Sin Especialidad') }}">
                @foreach($especialidades as $especialidad)
                    <option value="{{$especialidad->nombre_especialidad}}">
                @endforeach
            </datalist>

            <label for="turno" class="block font-bold md:text-right mb-1 md:mb-0 pr-4">
                {{ __("Turno") }}
            </label>
            <input name="turno" value="{{ $turno }}" list="turnoo" class="mr-5 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" id="username" type="text">
            <datalist id="turnoo">
                @foreach($turnos as $turno)
                    @if($turno->id != 1 && $turno->id != 2)
                        <option value="{{ $turno->turnos }}">
                    @endif
                @endforeach
            </datalist>

            <input
                type="submit"
                class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded"
                value="Buscar"
            >

        </div>
    </form>
</div>

<br>
<!-- Reporte -->
<div class="flex justify-center flex-wrap">
    <form
        action="{{ route('descargarPDFMedicos') }}"
        method="GET"
    >
        <input type="hidden" name="ci2" value="{{ $ci }}">
        <input type="hidden" name="nombre2" value="{{ $nombre }}">
        <input type="hidden" name="apellido2" value="{{ $apellido }}">
        <input type="hidden" name="especialidad2" value="{{ $especialidad2 }}">
        <input type="hidden" name="turno2" value="{{ $turno2 }}">
        <input
            type="submit"
            class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded"
            value="Buscar"
        >
    </form>
</div>
<br>
<!-- LISTA -->
<table class="border-collapse border text-center border-gray-500" style="width:100%">
    <thead>
        <tr>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("CI") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("APELLIDOS") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("NOMBRES") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("FECHA DE  NACIMIENTO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("CELULAR") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("ESPECIALIDAD") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("SALARIO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("TURNO") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("OPCIONES") }}</th>
        </tr>
    </thead>
    <tbody>
        @forelse($medicos as $medico)
            <tr>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->ci }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->apellidos }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->nombres }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->f_nac }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->cel }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">
                @isset($medico->especialidades->nombre_especialidad)
                    {{ $medico->especialidades->nombre_especialidad }}
                @else
                    {{ __("Sin Especialidad") }}
                @endisset
                </td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->salarios->Salario }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $medico->turnos }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">
                    <div class="inline-flex">
                        <a href="{{ route('medico.edit', ['medico' => $medico]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                            {{ __("Modificar") }}
                        </a>
                        <a
                            href="#"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
                            onclick="
                                event.preventDefault();
                                document.getElementById('delete-medico-{{ $medico->id }}-form').submit();
                            "
                        >
                            {{ __("Eliminar") }}
                        </a>
                        <form
                            id="delete-medico-{{ $medico->id }}-form"
                            method="POST"
                            action="{{ route('medico.destroy', ['medico' => $medico]) }}"
                            class="hidden"
                        >
                            @method("DELETE")
                            @csrf
                        </form>
                    </div>
                </td>
            </tr>
            @if($medico->count())
                <div class="mt-4">
                    {{ $medicos->links() }}
                </div>
            @endif
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
