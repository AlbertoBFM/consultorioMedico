@extends("layouts.app")
@section('content')
<div class="flex justify-center flex-wrap bg-gray-200 p-4">
    <div class="text-center">
        @isset($consultas[0]->medico->nombres)
            <h1 class="mb-0 text-4xl">{{ $consultas[0]->medico->nombres }} {{ $consultas[0]->medico->apellidos }}</h1>
        @else
            <h2 class="mb-0 text-4xl">{{ __("Sin consultas el día de hoy") }}</h1>
        @endisset
    </div>
</div>

<div class="container mx-auto">
    <table class="border-collapse border text-center border-gray-500 mt-4 mx-auto" style="width:90%">
        <thead>
            <tr>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("MOTIVO DE LA CONSULTA") }}</th>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("FECHA") }}</th>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("PACIENTE") }}</th>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("TIPO DE CONSULTA") }}</th>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("COSTO") }}</th>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("ATENDIDO") }}</th>
                <th class="bg-blue-900 text-gray-100 px-4 py-2">{{ __("OPCIÓN") }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($consultas as $consulta)
                @if($consulta->tipo_id == 4)
                    @php $color="bg-red-200"; $text="text-red-800" @endphp
                @else
                    @php $color="bg-white"; $text="text-gray-800" @endphp
                @endif
                <tr>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">{{ $consulta->motivo_consulta }}</td>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">{{ $consulta->fecha }}</td>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">{{ $consulta->paciente->ci }}</td>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">
                        @isset($consulta->tipos->especialidades->nombre_especialidad)
                            {{ $consulta->tipos->especialidades->nombre_especialidad }}
                        @else
                            @if($consulta->tipo_id == 1)
                                {{ __("General") }}
                            @elseif($consulta->tipo_id == 2)
                                {{ __("Reconsulta") }}
                            @elseif($consulta->tipo_id == 3)
                                {{ __("Domicilio") }}
                            @elseif($consulta->tipo_id == 4)
                                {{ __("Emergencia") }}
                            @endif
                        @endisset
                    </td>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">{{ $consulta->tipos->precio_consulta }}</td>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">{{ $consulta->atentido }}</td>
                    <td class="border-solid border-2 border-gray-500 {{ $color }} text-xs px-4 py-2">
                        <div class="w-full flex items-center justify-center">
                            <a href="{{ route('diagnostico.create', ['consulta' => $consulta]) }}" class="hover:bg-gray-400 {{$text}} font-bold py-2 px-4 rounded">
                                {{ __("Realizar Diagnostico") }}
                            </a>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border-solid border-2 border-gray-500 px-4 py-2" colspan="7">
                        {{ __("LISTA DE CONSULTAS VACIA") }}
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @isset($consulta)
        @if($consulta->count() != null)
            @if($consulta->count())
                <div class="mt-4">
                    {{ $consultas->links() }}
                </div>
            @endif
        @endif
    @endisset
</div>
<br>
<br>
@endsection
