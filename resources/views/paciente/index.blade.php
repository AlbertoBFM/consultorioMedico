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
                    <a class="text-orange-400" href="{{ route('paciente.edit',['paciente'=>$paciente])}}">{{ __("Modificar") }}</a>
                    |
                    <a 
                        class="text-red-400" 
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