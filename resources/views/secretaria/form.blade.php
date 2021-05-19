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
                    placeholder="juacito@gmail.com"
                    required
                >
                @error("email")
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
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
                value="{{ old('ci') ?? $secretaria->ci }}"
                placeholder="15112775"
            >
            @error("ci")
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
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
                value="{{ old('apellidos') ?? $secretaria->apellidos }}"
                placeholder="Pinto Ortega"
            >
            @error("apellidos")
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
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
                value="{{ old('nombres') ?? $secretaria->nombres }}"
                placeholder="Juancito Rodrigo"
            >
            @error("nombres")
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
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
                value="{{ old('f_nac') ?? $secretaria->f_nac }}"
            >
            @error("f_nac")
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
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
                value="{{ old('cel') ?? $secretaria->cel }}"
                placeholder="76167710"
            >
            @error("cel")
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <!-- SELECCIÓN TURNO -->
        <div class="md:flex md:items-center mb-6">
            <div class="md:w-1/3">
                <label for="Turno" class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                    {{ __("Turno") }}
                </label>
            </div>
            <div class="md:w-1/3">
                <select name="turno" id="turno" class="form-select form-select-lg mb-3">
                    @if($secretaria->turnos_id == 1)
                        <option value="1" selected> {{ __("08:30 - 14:30") }}</option>
                        <option value="2"> {{ __("14:30 - 20:30") }}</option>
                    @else
                        <option value="1"> {{ __("08:30 - 14:30") }}</option>
                        <option value="2" selected> {{ __("14:30 - 20:30") }}</option>
                    @endif
                </select>
            </div>
        </div>

    <div class="md:flex md:items-center">
        <div class="md:w-1/3"></div>
        <div class="md:w-2/3">
            <button class="shadow bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                {{ $textButton }}
            </button>
        </div>
    </div>
</form>
