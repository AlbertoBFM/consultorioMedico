<div class="w-full bg-gray-200 p-4 my-5">
    <div class="text-center">
        <h1 class="mb-5 text-4xl">{{ $title }}</h1>
    </div>
</div>
<form
    class="w-full max-w-sm"
    method="POST"
    action="{{ $route }}"
>
    @csrf
    @isset($update)
        @method("PUT")
    @else
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                    {{ __("Email") }}
                </label>
            </div>
            <div class="md:w-2/3">
                <input
                    class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                    id="email"
                    name="email"
                    type="text"
                    placeholder="alberto.brandon2@gmail.com"
                    required
                >
                @error("email")
                    <p class="text-red-500 text-xs italic">{{ __("EMAIL YA REGISTRADO, O EMAIL NO VALIDO") }}</p>
                @enderror
            </div>
        </div>
    @endisset

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="ci">
            {{ __("CI") }}
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                id="ci"
                name="ci"
                type="text"
                value="{{ old('ci') ?? $medico->ci }}"
                placeholder="15112775"
            >
            @error("ci")
                <p class="text-red-500 text-xs italic">{{ __("CI YA REGISTRADO, AL MENOS 8 CARACTERES, SOLO NÚMEROS") }}</p>
            @enderror
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                {{ __("Apellidos") }}
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                id="apellidos"
                name="apellidos"
                type="text"
                value="{{ old('apellidos') ?? $medico->apellidos }}"
                placeholder="Pinto Ortega"
            >
            @error("apellidos")
                <p class="text-red-500 text-xs italic">{{ __("SOLO LETRAS") }}</p>
            @enderror
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                {{ __("Nombres") }}
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                id="nombres"
                name="nombres"
                type="text"
                value="{{ old('nombres') ?? $medico->nombres }}"
                placeholder="Juancito Rodrigo"
            >
            @error("nombres")
                <p class="text-red-500 text-xs italic">{{ __("SOLO LETRAS") }}</p>
            @enderror
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                {{ __("Fecha de Nacimiento") }}
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                id="f_nac"
                name="f_nac"
                type="date"
                value="{{ old('f_nac') ?? $medico->f_nac }}"
            >
            @error("f_nac")
                <p class="text-red-500 text-xs italic">{{ __("SOLO MAYORIA DE EDAD") }}</p>
            @enderror
        </div>
    </div>

    <div class="md:flex md:items-center mb-6">
        <div class="md:w-1/3">
            <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="inline-password">
                {{ __("Celular") }}
            </label>
        </div>
        <div class="md:w-2/3">
            <input
                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"
                id="cel"
                name="cel"
                type="text"
                value="{{ old('cel') ?? $medico->cel }}"
                placeholder="76167710"
            >
            @error("cel")
                <p class="text-red-500 text-xs italic">{{ __("Celular ya registrado, al menos 8 caracteres, Solo números") }}</p>
            @enderror
        </div>
    </div>
    @if(!isset($update))
    <!-- SELECCIÓN ESPECIALIDAD -->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="especialidad" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                    {{ __("Especialidad") }}
                </label>
            </div>
            <div class="md:w-1/3">
                <select name="especialidad" id="especialidad" class="form-select form-select-lg mb-3">
                    <option value="0"> {{ __("Sin Especialidad") }}</option>
                    @foreach($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}"> {{ $especialidad->nombre_especialidad }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif
    <!-- SELECCIÓN TURNO -->
    @isset($update)
        @if(!(isset($medico->especialidad_id)))
            <div class="md:flex md:items-center mb-6">
                <div class="md:w-1/3">
                    <label for="Turno" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                        {{ __("Turno") }}
                    </label>
                </div>
                <div class="md:w-1/3">
                    <select name="turno" id="turno" class="form-select form-select-lg mb-3">
                        @foreach($turnos as $turno)
                            @php
                                $auxiliar = 1
                            @endphp
                            @if($medico->turnos_id == $turno->id)
                                <option value="{{ $turno->id }}" selected> {{ $turno->turnos }}</option>
                            @elseif($turno->id != 1 && $turno->id != 2)
                                @foreach($turnosOcupados as $turnoOcupado)
                                    @if($turnoOcupado->id == $turno->id)
                                        @php
                                            $auxiliar = 0
                                        @endphp
                                    @endif
                                @endforeach
                                @if($auxiliar != 0)
                                    <option value="{{ $turno->id }}"> {{ $turno->turnos }}</option>
                                @endif
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    @endisset
    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                {{ $textButton }}
            </button>
        </div>
    </div>
</form>
