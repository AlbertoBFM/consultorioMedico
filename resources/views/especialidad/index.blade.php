@extends("layouts.app")
@section('content')
<div class="w-100 bg-gray-200 p-4 mt-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">{{ __("Lista de Médicos") }}</h1>
        <a href="{{ route('especialidad.create') }}" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 my-4 border border-blue-500 hover:border-transparent rounded">
            {{ __("Registrar Especialidad") }}
        </a>
    </div>
</div>
<table class="border-collapse border text-center border-gray-500 m-auto mt-5" style="width:50%">
    <thead>
        <tr>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("Nombre") }}</th>
            <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("Acciones") }}</th>
    </thead>
    <tbody>
        @forelse($especialidades as $especialidad)
            <tr>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">{{ $especialidad->nombre_especialidad }}</td>
                <td class="border-solid border-2 border-gray-500 text-xs px-4 py-2">
                    <div class="inline-flex">
                        <a href="{{ route('especialidad.edit', ['especialidad' => $especialidad]) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                            {{ __("Modificar") }}
                        </a>
                        <a
                            href="#"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r"
                            onclick="
                                event.preventDefault();
                                document.getElementById('delete-especialidad-{{ $especialidad->id }}-form').submit();
                            "
                        >
                            {{ __("Eliminar") }}
                        </a>
                        <form
                            id="delete-especialidad-{{ $especialidad->id }}-form"
                            method="POST"
                            action="{{ route('especialidad.destroy', ['especialidad' => $especialidad]) }}"
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
                    {{ __("LISTA DE Especialidades VACIA") }}
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
@if($especialidad->count())
    <div class="mt-4">
        {{ $especialidades->links() }}
    </div>
@endif
@endsection
